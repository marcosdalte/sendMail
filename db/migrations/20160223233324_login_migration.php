<?php

use Phinx\Migration\AbstractMigration;

class LoginMigration extends AbstractMigration
{
    public function change()
    {
        // create the table
        $table = $this->table('login', array('id' => 'login_id'));
        $table->addColumn('username', 'string', array('limit' => 45, 'null' => false))
              ->addColumn('password', 'string', array('limit' => 100, 'null' => false))
              ->addIndex('username', array('unique' => true))
              ->create();
    }
}
