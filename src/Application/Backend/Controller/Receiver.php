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
            $receiver = new BusinessReceiver;

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    return $receiver->listing($kwargs);
                    break;
                
                case 'POST':
                    return $receiver->add($kwargs);
                    break;
                
                case 'PUT':
                    return $receiver->edit($kwargs);
                    break;
            }
        }
    }
}