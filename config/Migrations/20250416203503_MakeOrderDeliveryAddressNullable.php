<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class MakeOrderDeliveryAddressNullable extends BaseMigration
{
    public function change(): void
    {
        $table = $this->table('orders');
        $table
            ->changeColumn(
                'order_delivery_address',
                'string',
                [
                    'limit'   => 255,
                    'null'    => true,
                    'default' => null,
                ]
            )
            ->save();
    }
}
