
<section class="contact-form" id="users-index">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>Thank you for your payment!</h2>
            <p>Please save a copy of your order details.</p><br>
            <h5>Items Purchased:</h5>
            <ul>
                <?php foreach ($order->cart->cart_products as $item): ?>
                    <li>
                        <?= h($item->product->product_name) ?> × <?= h($item->product_quantity) ?> —
                        <?= $this->Number->currency($item->subtotal, 'AUD') ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p>Your order ID is <strong>#<?= h($order->id) ?></strong>.</p>

            <div style="padding:30px">
                <?= $this->Form->postLink(
                    'Return to Homepage',
                    ['action' => 'finalizeOrder', $order->cart_id],
                    ['class' => 'btn btn-primary', 'confirm' => 'Please take a screenshot of this page and save it before you leave!']
                ) ?></div>

        </div>

    </div>
</section>
