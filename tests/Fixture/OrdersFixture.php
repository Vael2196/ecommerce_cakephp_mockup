<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'order_id' => 1,
                'user_id' => 1,
                'cart_id' => 1,
                'order_createdAt' => '2025-04-10 08:21:26',
                'order_delivery_address' => 'Lorem ipsum dolor sit amet',
                'order_status' => 1,
            ],
        ];
        parent::init();
    }
}
