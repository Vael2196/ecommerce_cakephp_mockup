<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProducts extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('products');
        $table->addColumn('supplier_id', 'integer', [
            'null' => true, // optional FK
        ])
            ->addColumn('product_name', 'string', [
                'limit' => 100,
                'null' => false
            ])
            ->addColumn('product_description', 'text', [
                'null' => true
            ])
            ->addColumn('price', 'decimal', [
                'precision' => 10,
                'scale' => 2,
                'null' => false
            ])
            ->addColumn('quantity', 'integer', [
                'null' => false,
                'default' => 0
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP'
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ])
            ->addForeignKey('supplier_id', 'suppliers', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}
