<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentsFixture
 */
class PaymentsFixture extends TestFixture
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
                'payment_id' => 1,
                'order_id' => 1,
                'payment_date' => '2025-04-10 08:21:33',
                'payment_status' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
