<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CartProductsFixture
 */
class CartProductsFixture extends TestFixture
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
                'cart_id' => 1,
                'product_id' => 1,
                'product_quantity' => 1,
                'subtotal' => 1.5,
                'created' => '2025-04-09 16:00:42',
                'modified' => '2025-04-09 16:00:42',
            ],
        ];
        parent::init();
    }
}
