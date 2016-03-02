<?php

namespace Application\Backend {
    class Url {
        static public function url() {
            return [
                '/^\/backend\/login\/?$/' => ['Backend/Login/index',['GET','POST']],
                '/^\/backend\/home\/?$/'  => ['Backend/Home/index',['GET']],
                '/^\/backend\/receiver\/register\/?$/'  => ['Backend/Receiver/setReceiver',['GET','POST']],
                '/^\/backend\/receiver\/query\/?$/'  => ['Backend/Receiver/getReceiver',['GET','POST']],
            ];
        }
    }
}