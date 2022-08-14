<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Historic extends AbstractMigration
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
        $table = $this->table('historics');
        $table->addColumn('action', 'string', ['limit' => 30])
        ->addColumn('message', 'string', ['limit' => 200, 'null' => true])
        ->addColumn('data', 'date')
        ->addColumn('physical_people_id','integer',['null' => true])
        ->addColumn('legal_people_id','integer',['null' => true])
        ->addTimestamps()
        ->create();
        $table->addForeignKey('physical_people_id', 'physical_persons', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
        ->save();
        $table->addForeignKey('legal_people_id', 'legal_persons', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
        ->save();
    }
}
