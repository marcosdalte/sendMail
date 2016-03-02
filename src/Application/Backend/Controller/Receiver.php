<?php

namespace Application\Backend\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Model\Receiver as ModelReceiver;
    use \Exception as Exception;

    class Receiver extends Controller {
        private $db_transaction;
        
        public function __construct($request_method = null) {
            parent::__construct($request_method);
            
            // load transaction object
            $this->db_transaction = new Transaction();
        }

        public function setReceiver() {
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
        
        public function getReceiver() {
            $receiver = new ModelReceiver($this->db_transaction);
            
            $this->db_transaction->connect();
            
            $receiver_list = $receiver
                ->where()
                ->orderBy()
                ->limit(1,5)
                ->execute([
                    'join' => 'left']);
                
            Util::renderToJson($receiver_list);
            //require(ROOT_PATH.'/Application/Backend/view/receiver.html');
        }
    }
}