<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PhysicalPerson extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('physical_persons');
        $table->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('cpf',  'string', ['limit' => 20, 'null' => true])
            ->addColumn('password', 'string')
            ->addColumn('rg',   'string', ['limit' => 20])
            ->addColumn('birthDate', 'string')        
            ->addColumn('cellphone', 'string', ['limit' => 20])
            ->addColumn('account_id','integer',['null' => true])
            ->addColumn('address_id','integer',['null' => true])
            ->addTimestamps()
            ->create();
            $table->addForeignKey('account_id', 'accounts', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->save();
            $table->addForeignKey('address_id', 'address', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->save();
    }
}
