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
                '/^\/api\/receivers(\/[0-9]+)?$/' => ['Backend/Receiver/dispatch', ['GET','POST','DELETE','PUT']],
                '/^\/api\/users(\/[0-9]+)?$/' => ['Backend/User/dispatch', ['GET','POST','DELETE','PUT']],
                '/^\/api\/employees(\/[0-9]+)?$/' => ['Backend/Employee/dispatch', ['GET','POST','DELETE','PUT']],
                '/^\/api\/templates(\/[0-9]+)?$/' => ['Backend/Template/dispatch', ['GET','POST','DELETE','PUT']],
                '/^\/api\/events(\/[0-9]+)?$/' => ['Backend/Events/dispatch', ['GET','POST','DELETE','PUT']]];
                //'/^\/api\/receivers(\/(?P<id>\d+)\/(?P<nome>\w+))?$/' => ['Backend/Receiver/dispatch', ['GET','POST','DELETE','PUT']],
            return $url;
        }
    }
}