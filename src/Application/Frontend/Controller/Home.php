<?php

namespace Application\Frontend\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;

    class Home extends Controller {
        public function __construct($request_method = null) {
            parent::__construct($request_method);
        }

        public function index() {
            require(ROOT_PATH.'/Application/Frontend/view/index.html');
        }
    }
}