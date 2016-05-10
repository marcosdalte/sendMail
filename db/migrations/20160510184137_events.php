<?php

use Phinx\Migration\AbstractMigration;

class Events extends AbstractMigration
{
    public function change()
    {
        // create table events
        $table = $this->table('events', array('id' => 'events_id'));
        $table->addColumn('event', 'string', array('limit' => 50, 'null' => false))
              ->addColumn('dt_event', 'date', array('null' => false))
              ->addColumn('bl_active', 'enum', array('values' => array('y', 'n'), 'null' => false, 'default' => 'y'))
              ->addColumn('template_id', 'integer')
              ->addIndex(array('template_id','event','bl_active'), array('unique' => true))
              ->addForeignKey(array('template_id'), 'template',
                              array('template_id'),
                              array('delete' => 'NO_ACTION', 'update' => 'NO_ACTION'))
              ->create();
    }
}
