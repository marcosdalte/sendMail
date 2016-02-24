<?php

namespace Application\Backend {
    class Url {
        static public function url() {
            return [
                '/^\/backend/home\/?$/' => ['Backend/Home/index',['GET']],
            ];
        }
    }
}