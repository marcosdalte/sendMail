<?php

namespace Application\Backend\Model {
    use Core\Model;

    class Employee extends Model {
        public $employee_id;
        public $bl_active;
        public $dt_admission;
        public $receiver_id;

        protected function schema() {
            return [
                'employee_id' => Model::primaryKey(),
                'bl_active' => Model::char(['length' => 2]),
                'dt_admission' => Model::date(),
                'receiver_id' => Model::foreignKey(["table" => new Receiver, "null" => 0]),
            ];
        }
        
        protected function name() {
            return 'employee';
        }
    }
}
