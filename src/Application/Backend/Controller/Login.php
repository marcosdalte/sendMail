<?php

namespace Application\Backend\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Model\User;
    use Application\Backend\Business\Auth\Auth;
    use \Exception as Exception;

    class Login extends Controller {
        private $db_transaction;

        public function __construct($request_method = null) {
            parent::__construct($request_method);
            
            // load transaction object
            $this->db_transaction = new Transaction();
        }

        public function index() {
            if (!empty($_POST)) {
                // $user = Util::get('user',$_POST,null);
                // $password = Util::get('password',$_POST,null);
                
                $username = $_POST['username'];
                $password = $_POST['password'];

                if (empty($username) || empty($password)) {
                    throw new Exception('verificar o erro');
                }
                
                try {
                    // open connection with begin transaction
                    // $this->transaction->connect();
                    $this->db_transaction->beginTransaction();
    
                    // consulta o model login, com os dados passados pelo formulario
                    $login = new User($this->db_transaction);
    
                    
                    // [ 'username', 'password' ]
                    $user = $login->get([
                        'username' => $username,
                        // 'password' => $password,
                    ]);
                    
                    // $hash = password_hash($password, PASSWORD_BCRYPT);
                    if (!password_verify($password, $user->password)) {
                        throw new Exception('verificar o erro');
                    }
                     
                    $this->db_transaction->commit();

                } catch (Exception $error) {
                    $this->db_transaction->rollBack();

                    throw new Exception($error->getMessage());
                }

                Util::renderToJson($login);
            }

            require(ROOT_PATH.'/Application/Backend/view/login.html');
        }
        /**
         * Autenticação de usuario
         * 
         * Faz uma autenticação de usuario com os dados de username e password passados por post
         * em caso de sucesso cria um cookie com o nome do usuario(username) e um hash md5 da senha(password)
         * 
         * Retorna um json com dois dados, success e message.
         * 
         * @return json 
         * 
         */
        public function auth() {
            try {
                $auth = new Auth($_POST);
                $auth_init = $auth->init();

            } catch (Exception $error) {
                $auth->clearCookie();

                return Util::renderToJson([
                    'success' => false,
                    'message' => $error->getMessage()]);
            }
            
            return Util::renderToJson([
                'success' => true,
                'message' => $auth_init]);
        }
    }
}
