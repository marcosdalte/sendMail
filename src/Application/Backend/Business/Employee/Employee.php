<?php

namespace Application\Backend\Business\Employee {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Model\Employee as ModelEmployee;
    use Application\Backend\Model\Receiver as ModelReceiver;
    use \Exception as Exception;

    class Employee extends Controller {
        private $db_transaction;
        private $limit = 20;
        private $page = 1;
        
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

                // @TODO validation
                $this->db_transaction->connect();
                $employee = new ModelEmployee($this->db_transaction);
                $receiver = new ModelReceiver($this->db_transaction);
                
                // open connection with begin transaction
                $this->db_transaction->beginTransaction();

                $receiver->get([
                    'receiver_id' => $data['receiver_id']]);
                
                $employee->save([
                    'dt_admission' => $data['dt_admission'],
                    'receiver_id' => $receiver,
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
                $user_id = substr($kwargs[0], 1, 20);
                
                $data = json_decode(file_get_contents("php://input"), true);
                if (json_last_error() !== 0) {
                    throw new Exception('Mandatory field not sent ');
                }
                // @TODO validation
                $this->db_transaction->connect();
                $user = new ModelUser($this->db_transaction);
                
                // open connection with begin transaction
                $this->db_transaction->beginTransaction();
                
                $user->get(['user_id'=> $user_id]);
                
                if(!empty($data['username']))
                    $user->username = $data['username'];
                
                if(!empty($data['password']))
                    $user->password = $data['password'];
                
                $user->save();
                
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
            $employee = new ModelEmployee($this->db_transaction);
            
            $page = Util::get($_GET,'page',$this->page);
            $limit = Util::get($_GET,'limit',$this->limit);
            
            $this->db_transaction->connect();
            $employee_list = $employee
                ->where()
                ->orderBy()
                ->limit($page,$limit)
                ->execute([
                    'join' => 'left']);
            return Util::renderToJson($employee_list);
        }
    }
}