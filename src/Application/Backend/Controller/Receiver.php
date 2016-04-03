<?php

namespace Application\Backend\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Business\Receiver\Receiver as BusinessReceiver;
    use Application\Backend\Model\Receiver as ModelReceiver;
    use \Exception as Exception;

    class Receiver extends Controller {
        private $db_transaction;
        
        public function __construct($request_method = null) {
            parent::__construct($request_method);
            
            // load transaction object
            $this->db_transaction = new Transaction();
        }
        /**
         * Método utilizado para triar o tipo de requisição
         * Para cada tipo de requisição HTTP, será delegado um método especifico.
         * 
         * A classe que contem os métodos está no pacote 
         * Application\Backend\Business\Receiver
         * 
         * @autor wborba <wborba.dev@gmail.com>
         * @return Class Receiver
         * 
         */
        public function dispatch(...$kwargs) {
            print_r($kwargs);
            $receiver = new BusinessReceiver;
            echo "SERVER..: " . $_SERVER['REQUEST_METHOD'] . "\n";

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    return $receiver->listing($kwargs);
                    break;
                
                case 'PUT':
                    return $receiver->add($kwargs);
                    break;
                
                case 'POST':
                    return $receiver->edit($kwargs);
                    break;
            }
        }

        public function add() {
            try {
                $data = json_decode(file_get_contents("php://input"), true);
                if (json_last_error() !== 0) {
                    throw new Exception('Mandatory field not sent ');
                }
                // TODO validation

                $receiver = new ModelReceiver($this->db_transaction);

                // open connection with begin transaction
                $this->db_transaction->beginTransaction();

                $receiver->save([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'dt_birthday' => $data['birthday'],
                ]);

                // throw new Exception('My exception');
                $this->db_transaction->commit();

            } catch (Exception $e) {
                $this->db_transaction->rollBack();
                Util::renderToJson([
                    'success' => false,
                    'message' => 'Error on insert'//$e->getMessage()
                ]);
                exit;
            }
            Util::renderToJson(['success' => true]);

        }

        public function edit($id,...$kwargs) {
            if (!empty($_POST)) {
                //$name = $_POST['name'];
                $email = $_POST['email'];
                //$dt_birthday = $_POST['dt_birthday'];
        
                if (empty($name) || empty($email) || empty($dt_birthday)) {
                    throw new Exception('verificar o erro');
                }

                try {
                    // consulta o model receiver, com os dados passados pelo formulario
                    //$receiver = new ModelReceiver($this->db_transaction);

                    // open connection with begin transaction
                    //$this->db_transaction->beginTransaction();

                } catch (Exception $error) {
                    throw new Exception($error->getMessage());
                }

                Util::renderToJson($receiver);
            }
            require(ROOT_PATH.'/Application/Backend/view/receiver.html');
        }
    }
}