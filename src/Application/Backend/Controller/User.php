<?php
namespace Application\Backend\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Business\User\User as BusinessUser;
    use Application\Backend\Model\User as ModelUser;
    use \Exception as Exception;

    class User extends Controller {
        private $db_transaction;
        
        public function __construct($request_method = null) {
            parent::__construct($request_method);
            
            // load transaction object
            $this->db_transaction = new Transaction();
        }
        
        public function dispatch(...$kwargs) {
            $user = new BusinessUser;
            
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    return $user->listing($kwargs);
                    break;
                
                case 'POST':
                    return $user->add($kwargs);
                    break;
                
                case 'PUT':
                    return $user->edit($kwargs);
                    break;
            }
        }
    }
}