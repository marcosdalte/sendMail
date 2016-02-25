<?php

namespace Application\Backend\Model {
    use Core\Model;

    class Login extends Model {
        public $login_id;
        public $username;
        public $password;
        protected function schema() {
            return [
                'login_id' => Model::primaryKey(),
                'username' => Model::char(['length' => 45]),
                'password' => Model::char(['length' => 100]),
            ];
        }
        protected function name() {
            return 'login';
        }
    }
}
