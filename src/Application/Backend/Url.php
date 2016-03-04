<?php

namespace Application\Backend {
    class Url {
        static public function url() {
            return [
                '/^\/backend\/login\/?$/' => ['Backend/Login/index',['GET','POST']],
                '/^\/backend\/home\/?$/'  => ['Backend/Home/index',['GET']],
                '/^\/backend\/receiver\/add\/?$/'  => ['Backend/Receiver/add', ['PUT']],
                '/^\/backend\/receiver\/edit\/?$/'  => ['Backend/Receiver/edit',['POST']],
                '/^\/backend\/receiver\/list\/?$/'  => ['Backend/Receiver/getReceiver',['GET','POST']],
            ];
        }
    }
}