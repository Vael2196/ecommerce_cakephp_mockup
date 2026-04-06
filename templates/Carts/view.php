<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cart $cart
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cart'), ['action' => 'edit', $cart->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cart'), ['action' => 'delete', $cart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cart->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Carts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cart'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="carts view content">
            <h3><?= h($cart->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $cart->hasValue('user') ? $this->Html->link($cart->user->username, ['controller' => 'Users', 'action' => 'view', $cart->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($cart->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cart Total') ?></th>
                    <td><?= $this->Number->format($cart->cart_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($cart->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($cart->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Cart Products') ?></h4>
                <?php if (!empty($cart->cart_products)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Cart Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Product Quantity') ?></th>
                            <th><?= __('Subtotal') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($cart->cart_products as $cartProduct) : ?>
                        <tr>
                            <td><?= h($cartProduct->id) ?></td>
                            <td><?= h($cartProduct->cart_id) ?></td>
                            <td><?= h($cartProduct->product_id) ?></td>
                            <td><?= h($cartProduct->product_quantity) ?></td>
                            <td><?= h($cartProduct->subtotal) ?></td>
                            <td><?= h($cartProduct->created) ?></td>
                            <td><?= h($cartProduct->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CartProducts', 'action' => 'view', $cartProduct->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CartProducts', 'action' => 'edit', $cartProduct->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'CartProducts', 'action' => 'delete', $cartProduct->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $cartProduct->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>