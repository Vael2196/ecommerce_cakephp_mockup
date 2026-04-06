<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Cart> $carts
 */
?>
<div class="carts index content">
    <?= $this->Html->link(__('New Cart'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Carts') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('cart_total') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carts as $cart): ?>
                <tr>
                    <td><?= $this->Number->format($cart->id) ?></td>
                    <td><?= $cart->hasValue('user') ? $this->Html->link($cart->user->username, ['controller' => 'Users', 'action' => 'view', $cart->user->id]) : '' ?></td>
                    <td><?= $this->Number->format($cart->cart_total) ?></td>
                    <td><?= h($cart->created_at) ?></td>
                    <td><?= h($cart->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $cart->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cart->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $cart->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $cart->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>