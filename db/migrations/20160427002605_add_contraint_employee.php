<?php

use Phinx\Migration\AbstractMigration;

class AddContraintEmployee extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('employee');
        $table->addColumn('teste','string')
            ->addIndex(array('receiver_id'), array('unique' => true, 'name' => 'uk_receiver_id'))
            ->save();
    }
}