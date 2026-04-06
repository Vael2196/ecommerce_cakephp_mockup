<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int|null $supplier_id
 * @property string $product_name
 * @property string|null $product_description
 * @property string $price
 * @property int $quantity
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\CartProduct[] $cart_products
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'supplier_id' => true,
        'product_name' => true,
        'product_type' => true,
        'product_description' => true,
        'price' => true,
        'quantity' => true,
        'created' => true,
        'modified' => true,
        'supplier' => true,
        'cart_products' => true,
        'image' => true,
    ];
}
