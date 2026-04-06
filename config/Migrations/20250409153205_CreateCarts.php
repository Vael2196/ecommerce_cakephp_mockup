<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCarts extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('carts');
        $table->addColumn('user_id', 'integer', [
            'null' => false
        ])
            ->addColumn('cart_total', 'decimal', [
                'precision' => 10,
                'scale' => 2,
                'null' => false,
                'default' => 0.00
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP'
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}
