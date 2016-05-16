<?php

namespace Application\Backend\Model {
    use Core\Model;

    class Template extends Model {
        public $template_id;
        public $description;
        public $cd_template;
        public $path;
        public $bl_active;
        protected function schema() {
            return [
                'template_id' => Model::primaryKey(),
                'description' => Model::char(['length' => 100]),
                'cd_template' => Model::char(['length' => 30]),
                'path' => Model::char(['length' => 100]),
                'bl_active' => Model::char(['length' => 2]),
            ];
        }
        
        protected function name() {
            return 'template';
        }
    }
}
