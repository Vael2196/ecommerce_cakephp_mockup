<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $order_id
 * @property int|null $user_id
 * @property int|null $cart_id
 * @property \Cake\I18n\DateTime|null $order_createdAt
 * @property string|null $order_delivery_address
 * @property bool|null $order_status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Cart $cart
 */
class Order extends Entity
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
        'user_id' => true,
        'cart_id' => true,
        'order_createdAt' => true,
        'order_delivery_address' => true,
        'order_status' => true,
        'user' => true,
        'cart' => true,
    ];
}
