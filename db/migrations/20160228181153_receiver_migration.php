<?php

use Phinx\Migration\AbstractMigration;

class ReceiverMigration extends AbstractMigration
{
    public function change()
    {
        // create the table receiver
        $table = $this->table('receiver', array('id' => 'receiver_id'));
        $table->addColumn('name', 'string', array('limit' => 45, 'null' => false))
              ->addColumn('email', 'string', array('limit' => 45, 'null' => false))
              ->addColumn('dt_birthday', 'date', array('null' => false))
              ->addColumn('bl_active', 'enum', array('values' => array('y', 'n'), 'null' => false))
              ->addIndex(array('name', 'email'), array('unique' => true))
              ->create();
    }
}
