<?php

namespace Application\Backend\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Business\Template\Template as BusinessTemplate;
    use Application\Backend\Model\Template as ModelTemplate;
    use \Exception as Exception;

    class Template extends Controller {
        private $db_transaction;
        
        public function __construct($request_method = null) {
            parent::__construct($request_method);
            
            // load transaction object
            $this->db_transaction = new Transaction();
        }
        public function dispatch(...$kwargs) {
            $template = new BusinessTemplate;

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    return $template->listing($kwargs);
                    break;
                
                case 'POST':
                    return $template->add($kwargs);
                    break;
                
                case 'PUT':
                    return $template->edit($kwargs);
                    break;
            }
        }
    }
}