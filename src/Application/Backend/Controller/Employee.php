<?php
namespace Application\Backend\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Business\Employee\Employee as BusinessEmployee;
    use Application\Backend\Model\Employee as ModelEmployee;
    use \Exception as Exception;

    class Employee extends Controller {
        private $db_transaction;
        
        public function __construct($request_method = null) {
            parent::__construct($request_method);
            
            // load transaction object
            $this->db_transaction = new Transaction();
        }
        
        public function dispatch(...$kwargs) {
            $employee = new BusinessEmployee;
            
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    return $employee->listing($kwargs);
                    break;
                
                case 'POST':
                    return $employee->add($kwargs);
                    break;
                
                case 'PUT':
                    return $employee->edit($kwargs);
                    break;
            }
        }
    }
}