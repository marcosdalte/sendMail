<?php

namespace Application\Backend {
    class Url {
        static public function url() {
            // rotas html
            // DEPRECATED as rotas de html serão definidas no app Frontend
            $url = [
                '/^\/backend\/login\/?$/' => ['Backend/Login/index',['GET','POST']],
                '/^\/backend\/home\/?$/'  => ['Backend/Home/index',['GET']],];

            $url += [
                '/^\/api\/login\/auth\/?$/'        => ['Backend/Login/auth',['POST']],
                '/^\/api\/receiver\/add\/?$/'  => ['Backend/Receiver/add', ['PUT']],
                '/^\/api\/receiver\/edit\/?$/' => ['Backend/Receiver/edit',['POST']],
                '/^\/api\/receiver\/list\/?$/' => ['Backend/Receiver/getReceiver',['GET','POST']]];
            
            return $url;
        }
    }
}