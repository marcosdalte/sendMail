<?php

namespace Application\Restaurant\Model {
    use Core\Model;
    use Application\Restaurant\Model\Place;

    class Restaurant extends Model {
        public $id;
        public $place_id;
        public $name;
        public $serves_hot_dogs;
        public $serves_pizza;

        protected function schema() {
            return [
                'id' => Model::primaryKey(),
                'place_id' => Model::foreignKey(['table' => new Place,'null' => true]),
                'name' => Model::char(['length' => 40]),
                'serves_hot_dogs' => Model::boolean(['null' => false]),
                'serves_pizza' => Model::boolean(['null' => false]),];
        }

        protected function name() {
            return 'restaurant';
        }
    }
}