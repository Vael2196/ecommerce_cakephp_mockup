<?php

declare(strict_types=1);

use Migrations\BaseMigration;

class CreatePayments extends BaseMigration
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
        $table = $this->table('payments');
        $table->addColumn('order_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])
            ->addColumn('payment_date', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('payment_status', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addForeignKey('order_id', 'orders', 'id', ['delete' => 'CASCADE'])

            ->create();
    }
}
