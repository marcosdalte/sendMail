<?php

namespace Application\Backend\Model {
    use Core\Model;

    class User extends Model {
        public $user_id;
        public $username;
        public $password;
        protected function schema() {
            return [
                'user_id' => Model::primaryKey(),
                'username' => Model::char(['length' => 45]),
                'password' => Model::char(['length' => 100]),
            ];
        }

        protected function name() {
            return 'user';
        }
    }
}
