<?php

namespace Application\Backend\Model {
    use Core\Model;

    class Events extends Model {
        public $events_id;
        public $event;
        public $dt_event;
        public $bl_active;
        public $template_id;
        protected function schema() {
            return [
                'events_id' => Model::primaryKey(),
                'event' => Model::char(['length' => 50]),
                'dt_event' => Model::date(),
                'bl_active' => Model::char(['length' => 2]),
                'template_id' => Model::foreignKey(["table" => new Template, "null" => 0]),
            ];
        }
        
        protected function name() {
            return 'events';
        }
    }
}
