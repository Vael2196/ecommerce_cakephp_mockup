<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSuppliers extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('suppliers');
        $table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false
        ])
            ->addColumn('email', 'string', [
                'limit' => 150,
                'null' => false
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP'
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ])
            ->create();
    }
}
