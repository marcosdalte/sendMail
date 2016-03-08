<?php

namespace Application\Frontend {
    class Url {
        static public function url() {
            return [
                '/^\/frontend\/?$/' => ['Frontend/Home/index',['GET']],
            ];
        }
    }
}