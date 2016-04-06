<?php

namespace Application\Backend\Business\Receiver {
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

        public function add($kwargs) {
            try {
                $data = json_decode(file_get_contents("php://input"), true);
                if (json_last_error() !== 0) {
                    throw new Exception('Mandatory field not sent ');
                }
                
                // TODO validation
                $this->db_transaction->connect();
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
                    'message' => $e->getMessage()
                ]);
                exit;
            }
            Util::renderToJson(['success' => true]);

        }

        public function edit($kwargs) {
          try {
                echo $receiver_id = substr($kwargs[0], 1, 20);
                
                $data = json_decode(file_get_contents("php://input"), true);
                if (json_last_error() !== 0) {
                    throw new Exception('Mandatory field not sent ');
                }
                // TODO validation
                $this->db_transaction->connect();
                $receiver = new ModelReceiver($this->db_transaction);
                
                // open connection with begin transaction
                $this->db_transaction->beginTransaction();
                
                $receiver->get(['receiver_id'=> $receiver_id]);
                
                if(!empty($data['name']))
                    $receiver->name = $data['name'];
                
                if(!empty($data['email']))
                    $receiver->email = $data['email'];
                
                if(!empty($data['birthday']))
                    $receiver->dt_birthday = $data['birthday'];
                
                if(!empty($data['bl_active']))
                    $receiver->bl_active = $data['bl_active'];
                
                $receiver->save();
                
                $this->db_transaction->commit();

            } catch (Exception $error) {
                $this->db_transaction->rollBack();
                Util::renderToJson([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
                exit;
            }

            Util::renderToJson(['success' => true]);
        }

        public function listing($kwargs) {
            //@TODO GET page pagelimite
            $receiver = new ModelReceiver($this->db_transaction);
            
            $this->db_transaction->connect();
            
            $receiver_list = $receiver
                ->where()
                ->orderBy()
                ->limit()
                ->execute([
                    'join' => 'left']);

            return Util::renderToJson($receiver_list);
        }
    }
}