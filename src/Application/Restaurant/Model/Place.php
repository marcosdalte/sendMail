<?php

namespace Application\Restaurant\Model {
    use Core\Model;

    class Place extends Model {
        public $id;
        public $name;
        public $address;

        protected function schema() {
            return [
                'id' => Model::primaryKey(),
                'name' => Model::char(['length' => 40]),
                'address' => Model::char(['length' => 40]),];
        }

        protected function name() {
            return 'place';
        }
    }
}