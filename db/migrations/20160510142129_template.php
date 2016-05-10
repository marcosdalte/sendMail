<?php

use Phinx\Migration\AbstractMigration;

class Template extends AbstractMigration
{
    public function change()
    {
    // create table employee
    $table = $this->table('template', array('id' => 'template_id'));
    $table->addColumn('description', 'string', array('limit' => 100, 'null' => false))
          ->addColumn('cd_template', 'string', array('limit'=>30, 'null' =>false))
          ->addColumn('path', 'string', array('limit'=>100, 'null' =>false))          
          ->addColumn('bl_active', 'enum', array('values' => array('y', 'n'), 'null' => false, 'default' => 'y'))
          ->create();
    }
}
