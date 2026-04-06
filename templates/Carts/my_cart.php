<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cart $cart
 */
?>

<section class="contact-form" id="users-index">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;">
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center">
                    <h2>My Cart</h2>
                    <div class="border"></div>
                    <p class="mt-20">&#8592; <?= $this->Html->link(__('Continue shopping'), ['controller'=> 'Pages','action' => 'shop']) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// calculate total
$total = 0;
foreach ($cart->cart_products as $item) {
    $total += $item->subtotal;
}
?>

<div class="page-wrapper">
    <div class="cart shopping">
        <div class="container">
            <?php if (!empty($cart->cart_products)): ?>
            <p>Select a quantity and tap the screen to update</p>
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="block">
                            <div class="product-list table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product Name</th>
                                        <th>Product Type</th>
                                        <th>Product Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($cart->cart_products as $item): ?>
                                        <tr>
                                            <td>
                                                <?= !empty($item->product->image)
                                                    ? $this->Html->image('products/' . $item->product->image, ['alt'=>h($item->product->product_name), 'class'=>'fixed-size-image'])
                                                    : $this->Html->image('image-not-found.jpg', ['alt'=>'Product Image','class'=>'fixed-size-image']); ?>
                                            </td>
                                            <td><?= h($item->product->product_name) ?></td>
                                            <td><?= h($item->product->product_type) ?></td>
                                            <td><?= $this->Number->currency($item->product->price, 'AUD') ?></td>
                                            <td>
                                                <?php
                                                echo $this->Form->create(
                                                    null,
                                                    [
                                                        'url' => [
                                                            'controller' => 'Carts',
                                                            'action'     => 'updateQuantity',
                                                            $item->id
                                                        ],
                                                        'type' => 'post',
                                                        'templates' => [
                                                            'inputContainer'  => '{{content}}',
                                                            'buttonContainer' => ''
                                                        ],
                                                    ]
                                                );

                                                echo $this->Form->number('quantity', [
                                                    'value' => $item->product_quantity,
                                                    'min' => 1,
                                                    'max' => 999,
                                                    'class' => 'form-control form-control-sm qty-input',
                                                    'style' => 'width:60px; display:inline-block; border-width: 0px; background-color: #f7f7f7; color: black; padding-top: 0px; margin-top: -0.3em; font-size: 16px;'
                                                ]);
                                                echo $this->Form->end();
                                                ?>
                                            </td>
                                            <td><?= $this->Number->currency($item->subtotal, 'AUD') ?></td>
                                            <td>
                                                <?= $this->Form->postLink(
                                                    __('Remove'),
                                                    ['action' => 'remove', $item->id],
                                                    [
                                                        'confirm' => __('Are you sure you want to remove this item from your cart?'),
                                                        'class' => 'btn btn-danger btn-sm'
                                                    ]
                                                ) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3"></div>
                            <div>
                                <h3>Total: <?= $this->Number->currency($total, 'AUD') ?></h3>
                            </div>
                            <div id="cf-submit" style="padding-top:20px">
                                <p>Proceed to order summary</p>
                                <?= $this->Html->link(
                                    __('Checkout'),
                                    ['controller' => 'Orders', 'action' => 'orderSummary', $cart->id],
                                    ['class' => 'btn btn-primary']
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>Your cart is empty</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.qty-input').forEach(input => {
        input.addEventListener('blur', () => {
            input.closest('form').submit();
        });
    });
</script>
