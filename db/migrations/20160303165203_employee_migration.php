<?php

use Phinx\Migration\AbstractMigration;

class EmployeeMigration extends AbstractMigration
{
    public function change()
    {
        // create table employee
        $table = $this->table('employee', array('id' => 'employee_id'));
        $table->addColumn('bl_active', 'enum', array('values' => array('y', 'n'), 'null' => false, 'default' => 'y'))
              ->addColumn('dt_admission', 'date', array('null' => false))
              ->addColumn('receiver_id', 'integer')
              ->addForeignKey(array('receiver_id'), 'receiver',
                              array('receiver_id'),
                              array('delete' => 'NO_ACTION', 'update' => 'NO_ACTION'))
              ->create();
    }
}
