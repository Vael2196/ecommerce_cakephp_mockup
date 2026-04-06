<style>
    body{
        background:#eee;
    }
    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: 1rem;
    }
    .text-reset {
        --bs-text-opacity: 1;
        color: inherit!important;
    }
</style>

<section class="contact-form" id="users-index">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>Checkout</h2>
            <p></p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('Back to cart'), ['controller'=> 'Carts','action' => 'my_cart']) ?></p>
        </div>
    </div>
</section>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 mx-auto"> <!-- center the content -->
            <div class="mb-3 text-center">
<!--<div class="mb-3 d-flex justify-content-between">-->
<!--    <div class="d-flex">-->
        <h4>Order Summary</h4>
            </div>
            <tr class="fw-bold">
                <h5> Total: <?= $this->Number->currency($order->cart->cart_total, 'AUD') ?></h5>
            </tr>
            <table class="table table-borderless table-responsive" style="padding-top:15px">
                <?php foreach ($order->cart->cart_products as $item): ?>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0" style="padding: 10px">
                                    <?php if (!empty($item->product->image)): ?>
                                        <?= $this->Html->image('products/' . $item->product->image, [
                                            'alt' => h($item->product->product_name),
                                            'class' => 'fixed-size-image'
                                        ]) ?>
                                    <?php else: ?>
                                        <?= $this->Html->image('image-not-found.jpg', [
                                            'alt' => 'Product Image',
                                            'class' => 'fixed-size-image'
                                        ]) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-lg-grow-1 ms-3">
                                    <h6 class=" mb-0 text-reset">Item: <?= h($item->product->product_name) ?></h6>
                                    <span class="small">(<?= h($item->product->product_type) ?>)</span>
                                </div>
                            </div>
                        </td>
                        <td><?= __('Qty: ') .h($item->product_quantity) ?></td>
                        <td class="text-end">$<?= h($item->product->price) ?></td>
                        <td class="text-end">Price: <?= $this->Number->currency($item->subtotal, 'AUD') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="page-wrapper" style="padding-top: 30px">
    <div class="checkout shopping">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <div class="block billing-details">
                        <h4 class="widget-title" style="padding-bottom: 20px">Delivery Details</h4>
                        <?= $this->Form->create($order, ['url' => ['action' => 'confirmOrder', $order->cart->id]]) ?>
                        <div class="mb-3">
                            <?= $this->Form->control('order_delivery_address', [
                                'label' => 'Delivery Address',
                                'class' => 'form-control',
                                'placeholder' => 'Enter your delivery address',
                                'labelOptions' => ['class' => 'form-label']
                            ]) ?>
                        </div>
                        <div class="text-start mt-3">
                            <?= $this->Form->button(__('Confirm & Proceed to Payment'), ['class' => 'btn btn-success btn-sm']) ?>
                        </div>

                        <?= $this->Form->end() ?>


<!--                        <form class="checkout-form">-->
<!--                            <div class="form-group">-->
<!--                                <label for="full_name">Full Name</label>-->
<!--                                <input type="text" class="form-control" id="full_name" placeholder="">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="user_address">Address</label>-->
<!--                                <input type="text" class="form-control" id="user_address" placeholder="">-->
<!--                            </div>-->
<!--                            <div class="checkout-country-code clearfix">-->
<!--                                <div class="form-group">-->
<!--                                    <label for="user_post_code">Zip Code</label>-->
<!--                                    <input type="text" class="form-control" id="user_post_code" name="zipcode" value="">-->
<!--                                </div>-->
<!--                                <div class="form-group" >-->
<!--                                    <label for="user_city">City</label>-->
<!--                                    <input type="text" class="form-control" id="user_city" name="city" value="">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="user_country">Country</label>-->
<!--                                <input type="text" class="form-control" id="user_country" placeholder="">-->
<!--                            </div>-->
<!--                        </form>-->
                    </div>
                </div>

            </div>
        </div>
    </div>
<!--    <div class="text-center mt-3">-->
<!--        --><?php //= $this->Form->button(__('Confirm & Proceed to Payment'), ['class' => 'btn btn-success btn-sm']) ?>
<!--    </div>-->
</div>




<!--<h2 class="my-color mb-4">--><?php //= __('Order Summary') ?><!--</h2>-->
<!---->
<!--<div class="row">-->
<!--     LEFT: Order & Delivery Info-->
<!--    <div class="col-md-6">-->
<!--        <div class="card bg-dark text-white mb-4 p-3">-->
<!--            <div class="card-body">-->
<!--               <p><strong>--><?php //= __('User:') ?><!--</strong> --><?php //= h($order->user->username) ?><!--</p>-->
<!--                <p><strong>--><?php //= __('Cart Total:') ?><!--</strong> --><?php //= $this->Number->currency($order->cart->cart_total, 'AUD') ?><!--</p>-->
<!---->
<!--                --><?php //= $this->Form->create($order, ['url' => ['action' => 'confirmOrder', $order->cart->id]]) ?>
<!--                <div class="mb-3">-->
<!--                    --><?php //= $this->Form->control('order_delivery_address', [
//                        'label' => 'Delivery Address',
//                        'class' => 'form-control',
//                        'placeholder' => 'Enter your delivery address',
//                        'labelOptions' => ['class' => 'form-label']
//                    ]) ?>
<!--                </div>-->
<!--                <div class="text-start mt-3">-->
<!--                    --><?php //= $this->Form->button(__('Confirm & Proceed to Payment'), ['class' => 'btn btn-success btn-sm']) ?>
<!--                </div>-->
<!---->
<!--                --><?php //= $this->Form->end() ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--     RIGHT: Cart Items-->
<!--    <div class="col-md-6 my-text">-->
<!--        <div class="card bg-dark text-white p-3">-->
<!--            <h4 class="card-title mb-3">--><?php //= __('Cart Items') ?><!--</h4>-->
<!--            <div class="row">-->
<!--                --><?php //foreach ($order->cart->cart_products as $item): ?>
<!--                    <div class="col-12 mb-3">-->
<!--                        <div class="card bg-secondary text-white h-100">-->
<!--                            <div class="card-body">-->
<!--                                <h5 class="card-title">--><?php //= h($item->product->product_name) ?><!--</h5>-->
<!--                                <p class="card-text">-->
<!--                                    --><?php //= __('Quantity: ') . h($item->product_quantity) ?><!--<br>-->
<!--                                    --><?php //= __('Subtotal: ') . $this->Number->currency($item->subtotal, 'AUD') ?>
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //endforeach; ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
