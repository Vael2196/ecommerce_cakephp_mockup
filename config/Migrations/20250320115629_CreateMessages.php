<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateMessages extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('messages', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'null' => false,
        ])
            ->addColumn('name', 'string', [
                'limit' => 100,
                'null' => false
            ])
            ->addColumn('email', 'string', [
                'limit' => 100,
                'null' => false
            ])
            ->addColumn('subject', 'string', [
                'limit' => 150,
                'null' => false
            ])
            ->addColumn('message', 'text', [
                'null' => false
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP'
            ])
            ->create();
    }
}
