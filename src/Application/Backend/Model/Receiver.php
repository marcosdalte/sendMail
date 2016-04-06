<?php

namespace Application\Backend\Model {
    use Core\Model;

    class Receiver extends Model {
        public $receiver_id;
        public $name;
        public $email;
        public $dt_birthday;
        public $bl_active;
        protected function schema() {
            return [
                'receiver_id' => Model::primaryKey(),
                'name' => Model::char(['length' => 45]),
                'email' => Model::char(['length' => 100]),
                'dt_birthday' => Model::date(),
                'bl_active' => Model::char(['length' => 2]),
            ];
        }
        
        protected function name() {
            return 'receiver';
        }
    }
}
