<?php

namespace Application\Backend {
    class Url {
        static public function url() {
            // rotas html
            // DEPRECATED as rotas de html serão definidas no app Frontend
            $url = [
                '/^\/backend\/home\/?$/'  => ['Backend/Home/index',['GET']],];

            $url += [
                '/^\/api\/login\/auth\/?$/'       => ['Backend/Login/auth',['POST','GET']],
                '/^\/api\/receivers(\/[0-9]+)?$/' => ['Backend/Receiver/dispatch', ['GET','POST','DELETE','PUT']]];
                //'/^\/api\/receivers(\/(?P<id>\d+)\/(?P<nome>\w+))?$/' => ['Backend/Receiver/dispatch', ['GET','POST','DELETE','PUT']],

            return $url;
        }
    }
}