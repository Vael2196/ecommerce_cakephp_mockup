<?php

declare(strict_types=1);

use Migrations\BaseMigration;

class CreateOrders extends BaseMigration
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
        // Only create the table if it doesn't already exist
        if (!$this->hasTable('orders')) {
            $table = $this->table('orders');
            $table->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
                ->addColumn('cart_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('order_createdAt', 'datetime', [
                    'default' => null,
                    'null' => false,
                ])
                ->addColumn('order_delivery_address', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('order_status', 'boolean', [
                    'default' => null,
                    'null' => false,
                ])
                ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
                ->addForeignKey('cart_id', 'carts', 'id', ['delete' => 'SET_NULL'])
                ->create();
        }
    }
}
