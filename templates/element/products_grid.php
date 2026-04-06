<?php
/**
 * Element: products_grid
 *
 * Expects a variable $products. If not provided, it will load a default set from the Products table.
 */
if (!isset($products)) {
    $productsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Products');
    $products = $productsTable->find()
        ->orderBy(['Products.created' => 'DESC'])
        ->limit(50)
        ->toArray();
}
?>

<section class="py-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center parent-product-card">
            <?php foreach ($products as $product): ?>
            <div class="col mb-5 product-card" data-type="<?= h($product->product_type) ?>">
                <div class="card h-100 rounded-4 shadow-sm">
                    <!-- Product image-->
                    <?php if (!empty($product->image)): ?>
                        <?= $this->Html->image('products/' . $product->image, [
                            'alt' => h($product->product_name),
                            'class' => 'card-img-top product-image'
                        ]) ?>
                    <?php else: ?>
                        <?= $this->Html->image('image-not-found.jpg', [
                            'alt' => 'Product Image',
                            'class' => 'card-img-top product-image'
                        ]) ?>
                    <?php endif; ?>
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder product-title" title="<?= h($product->product_name) ?>">
                                <?= h($product->product_name) ?></h5>
                            <!-- Product type -->
                            <p class="card-text">(<?= h($product->product_type) ?>)</p>
                            <!-- Product description -->
                            <p class="card-text product-description"><?= h($product->product_description) ?></p>
                            <!-- Product price wrapped in sorting data attribute -->
                            <p class="price fw-bold" data-price="<?= $product->price ?>">
                                <?= $this->Number->currency($product->price, 'AUD') ?></p>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <!-- Product Qty input-->
                        <div class="cart-controls quantity-input d-flex justify-content-center align-items-center mb-3">
                            <button type="button" class="btn btn-sm btn-secondary quantity-btn decrement">&minus;</button>
                            <input type="text" value="1" class="quantity-value mx-2 text-center" maxlength="3" style="width: 50px;">
                            <button type="button" class="btn btn-sm btn-secondary quantity-btn increment">&#43;</button>
                        </div>

                        <div class="add-to-cart-wrapper mt-2">
                            <!-- Add product to cart-->
                            <a href="#" data-product-id="<?= $product->id ?>" class="btn btn-primary w-100 add-to-cart">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        function setupQuantityControls() {
            document.querySelectorAll('.quantity-input').forEach(function(control) {
                var input = control.querySelector('.quantity-value');
                var incBtn = control.querySelector('.increment');
                var decBtn = control.querySelector('.decrement');
                var timer = null;
                var startTime = 0;

                function updateValue(delta) {
                    var current = parseInt(input.value, 10) || 0;
                    current += delta;
                    if (current < 1) current = 1;
                    if (current > 999) current = 999;
                    input.value = current;
                }

                function startAdjust(isIncrement) {
                    updateValue(isIncrement ? 1 : -1);
                    startTime = Date.now();
                    timer = setTimeout(function() {
                        timer = setInterval(function() {
                            var elapsed = Date.now() - startTime;
                            var step = 1;
                            if (elapsed >= 4000) {
                                step = 100;
                            } else if (elapsed >= 3000) {
                                step = 10;
                            } else if (elapsed >= 2000) {
                                step = 5;
                            }
                            updateValue(isIncrement ? step : -step);
                        }, 300);
                    }, 1000);
                }

                function stopAdjust() {
                    clearTimeout(timer);
                    clearInterval(timer);
                }

                incBtn.addEventListener('mousedown', function(e) {
                    e.preventDefault();
                    startAdjust(true);
                });
                incBtn.addEventListener('mouseup', stopAdjust);
                incBtn.addEventListener('mouseleave', stopAdjust);

                decBtn.addEventListener('mousedown', function(e) {
                    e.preventDefault();
                    startAdjust(false);
                });
                decBtn.addEventListener('mouseup', stopAdjust);
                decBtn.addEventListener('mouseleave', stopAdjust);
            });
        }
        setupQuantityControls();

        document.querySelectorAll('.add-to-cart').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var productId = this.getAttribute('data-product-id');
                var quantityInput = this.closest('.card-footer').querySelector('.quantity-value');
                var quantity = quantityInput ? parseInt(quantityInput.value, 10) || 1 : 1;
                var url = "<?= $this->Url->build(['controller' => 'Carts', 'action' => 'addToCart']) ?>/" + productId + "?quantity=" + quantity;
                window.location.href = url;
            });
        });
    });
</script>
