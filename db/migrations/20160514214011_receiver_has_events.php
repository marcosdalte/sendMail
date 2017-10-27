<?php

use Phinx\Migration\AbstractMigration;

class ReceiverHasEvents extends AbstractMigration
{
    public function change()
    {
        // create table receiver_has_events
        $table = $this->table('receiver_has_events', array('id' => false, 'primary_key' => array('events_receiver_id', 'events_events_id', 'events_template_id')));
        $table->addColumn('events_receiver_id', 'integer')
              ->addColumn('events_events_id', 'integer')
              ->addColumn('events_template_id', 'integer')
              ->addIndex(array('events_receiver_id','events_events_id','events_template_id'), array('unique' => true))
              ->addForeignKey(array('events_receiver_id'), 'receiver',
                              array('receiver_id'),
                              array('delete' => 'NO_ACTION', 'update' => 'NO_ACTION'))
              ->addForeignKey(array('events_events_id'), 'events',
                              array('events_id'),
                              array('delete' => 'NO_ACTION', 'update' => 'NO_ACTION'))
              ->addForeignKey(array('events_template_id'), 'template',
                              array('template_id'),
                              array('delete' => 'NO_ACTION', 'update' => 'NO_ACTION'))                              
              ->create();
    }
}
