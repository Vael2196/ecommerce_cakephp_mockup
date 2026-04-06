<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CartsFixture
 */
class CartsFixture extends TestFixture
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
                'id' => 1,
                'user_id' => 1,
                'cart_total' => 1.5,
                'created_at' => '2025-04-09 15:59:59',
                'modified' => '2025-04-09 15:59:59',
            ],
        ];
        parent::init();
    }
}
