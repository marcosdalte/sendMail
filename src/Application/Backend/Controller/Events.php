<?php
namespace Application\Backend\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Business\Events\Events as BusinessEvents;
    use Application\Backend\Model\Events as ModelEvents;
    use \Exception as Exception;

    class Events extends Controller {
        private $db_transaction;
        
        public function __construct($request_method = null) {
            parent::__construct($request_method);
            
            // load transaction object
            $this->db_transaction = new Transaction();
        }
        
        public function dispatch(...$kwargs) {
            $events = new BusinessEvents;
            
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    return $events->listing($kwargs);
                    break;
                
                case 'POST':
                    return $events->add($kwargs);
                    break;
                
                case 'PUT':
                    return $events->edit($kwargs);
                    break;
            }
        }
    }
}