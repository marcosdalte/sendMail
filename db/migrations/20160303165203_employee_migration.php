<?php

use Phinx\Migration\AbstractMigration;

class EmployeeMigration extends AbstractMigration
{
    public function change()
    {
        // create table employee
        $table = $this->table('employee', array('id' => 'employee_id'));
        $table->addColumn('bl_active', 'enum', array('values' => array('y', 'n'), 'null' => false))
              ->addColumn('dt_admission', 'date', array('null' => false))
              ->addColumn('receiver_id', 'integer')
              ->addForeignKey(array('receiver_id'), 'receiver',
                              array('receiver_id'),
                              array('delete' => 'CASCADE', 'update' => 'CASCADE'))
              ->create();
    }
}
