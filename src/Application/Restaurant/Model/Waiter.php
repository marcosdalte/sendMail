<?php

namespace Application\Restaurant\Model {
    use Core\Model;
    use Application\Restaurant\Model\Restaurant;

    class Waiter extends Model {
        public $id;
        public $restaurant_id;
        public $name;

        protected function schema() {
            return [
                'id' => Model::primaryKey(),
                'restaurant_id' => Model::foreignKey(['table' => new Restaurant,'null' => true]),
                'name' => Model::char(['length' => 40]),];
        }

        protected function name() {
            return 'waiter';
        }
    }
}