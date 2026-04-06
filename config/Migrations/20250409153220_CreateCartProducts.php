<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCartProducts extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('cart_products');
        $table->addColumn('cart_id', 'integer', [
            'null' => false
        ])
            ->addColumn('product_id', 'integer', [
                'null' => false
            ])
            ->addColumn('product_quantity', 'integer', [
                'null' => false,
                'default' => 1
            ])
            ->addColumn('subtotal', 'decimal', [
                'precision' => 10,
                'scale' => 2,
                'null' => false,
                'default' => 0.00
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP'
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ])
            ->addForeignKey('cart_id', 'carts', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addForeignKey('product_id', 'products', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}
