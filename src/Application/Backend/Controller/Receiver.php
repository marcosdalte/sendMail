<?php

namespace Application\Backend\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    //use Application\Backend\Model\Login as ModelLogin;
    use \Exception as Exception;

    class Receiver extends Controller {
        public function __construct($request_method = null) {
            parent::__construct($request_method);
        }

        public function index() {
            require(ROOT_PATH.'/Application/Backend/view/receiver.html');
        }
    }
}