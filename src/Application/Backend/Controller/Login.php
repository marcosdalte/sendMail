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
                $auth = new Auth($_REQUEST);
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
