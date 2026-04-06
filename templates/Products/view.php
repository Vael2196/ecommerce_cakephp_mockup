<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<section class="contact-form" id="">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>View Product </h2>
<!--            <br><h3 style="color:darkred">--><?php //= h($product->product_name) ?><!--</h3>-->
            <p>Details</p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('List of Products'), ['controller'=> 'Products','action' => 'index']) ?></p>
        </div>
    </div>
</section>

<div class="d-flex justify-content-center align-items-center" style="min-height: 50vh;">
    <div class="dashboard-wrapper dashboard-user-profile w-100">
        <div class="row align-items-center">
            <div class="col-md-4 pull-left text-center" href="#!" style="padding-bottom: 30px">
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
            </div>

            <!-- Product information table -->
            <div class="media-body">
                <div class="col-12 col-md-8">
                    <div class="single-product-details">
                        <h3 style="color:darkred; padding-bottom: 20px"><?= h($product->product_name) ?></h3>
                        <table class="table">
                            <tr>
                                <th><?= __('Supplier') ?></th>
                                <td><?= $product->hasValue('supplier') ? $this->Html->link($product->supplier->name,
                                        ['controller' => 'Suppliers', 'action' => 'view', $product->supplier->id]) : '' ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <td><?= $this->Number->format($product->id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Product Name') ?></th>
                                <td><?= h($product->product_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Product Type') ?></th>
                                <td><?= h($product->product_type) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Product Description') ?></th>
                                <td><?= $this->Text->autoParagraph(h($product->product_description)); ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Price') ?></th>
                                <td><?= $this->Number->format($product->price) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Quantity') ?></th>
                                <td><?= $this->Number->format($product->quantity) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Created') ?></th>
                                <td><?= h($product->created) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Modified') ?></th>
                                <td><?= h($product->modified) ?></td>
                            </tr>
                            <tr>
                                <td class="actions d-flex gap-2">
                                    <div>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], [
                                            'class' => 'btn btn-warning btn-sm'
                                        ]) ?>
                                    </div>
                                    <div>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], [
                                            'method' => 'delete',
                                            'confirm' => __('Are you sure you want to delete # {0}?', $product->id),
                                            'class' => 'btn btn-danger btn-sm'
                                        ]) ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="row">-->
<!--    <aside class="column">-->
<!--        <div class="side-nav">-->
<!--            <h4 class="heading">--><?php //= __('Actions') ?><!--</h4>-->
<!--            --><?php //= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id], ['class' => 'side-nav-item']) ?>
<!--            --><?php //= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), 'class' => 'side-nav-item']) ?>
<!--            --><?php //= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
<!--            --><?php //= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
<!--        </div>-->
<!--    </aside>-->
<!--    <div class="column column-80">-->
<!--        <div class="products view content my-text">-->
<!--            <h3>--><?php //= h($product->product_name) ?><!--</h3>-->
<!--            <table class="table">-->
<!--                <tr>-->
<!--                    <th>--><?php //= __('Supplier') ?><!--</th>-->
<!--                    <td>--><?php //= $product->hasValue('supplier') ? $this->Html->link($product->supplier->name,
//                            ['controller' => 'Suppliers', 'action' => 'view', $product->supplier->id]) : '' ?>
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>--><?php //= __('Id') ?><!--</th>-->
<!--                    <td>--><?php //= $this->Number->format($product->id) ?><!--</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>--><?php //= __('Product Name') ?><!--</th>-->
<!--                    <td>--><?php //= h($product->product_name) ?><!--</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>--><?php //= __('Product Type') ?><!--</th>-->
<!--                    <td>--><?php //= h($product->product_type) ?><!--</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>--><?php //= __('Price') ?><!--</th>-->
<!--                    <td>--><?php //= $this->Number->format($product->price) ?><!--</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>--><?php //= __('Quantity') ?><!--</th>-->
<!--                    <td>--><?php //= $this->Number->format($product->quantity) ?><!--</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>--><?php //= __('Created') ?><!--</th>-->
<!--                    <td>--><?php //= h($product->created) ?><!--</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>--><?php //= __('Modified') ?><!--</th>-->
<!--                    <td>--><?php //= h($product->modified) ?><!--</td>-->
<!--                </tr>-->
<!--            </table>-->
<!--            --><?php //if (!empty($product->image)): ?>
<!--                <div class="product-image" style="margin: 20px 0;">-->
<!--                    --><?php //= $this->Html->image('products/' . $product->image, [
//                        'alt' => $product->product_name,
//                        'class' => 'img-fluid',
//                        'style' => 'max-width:300px;'
//                    ]) ?>
<!--                </div>-->
<!--            --><?php //endif; ?>
<!--            <div class="text">-->
<!--                <strong>--><?php //= __('Product Description') ?><!--</strong>-->
<!--                <blockquote>-->
<!--                    --><?php //= $this->Text->autoParagraph(h($product->product_description)); ?>
<!--                </blockquote>-->
<!--            </div>-->
<!--            <div class="related">-->
<!--                <h4>--><?php //= __('Related Cart Products') ?><!--</h4>-->
<!--                --><?php //if (!empty($product->cart_products)) : ?>
<!--                    <div class="table-responsive">-->
<!--                        <table>-->
<!--                            <tr>-->
<!--                                <th>--><?php //= __('Id') ?><!--</th>-->
<!--                                <th>--><?php //= __('Cart Id') ?><!--</th>-->
<!--                                <th>--><?php //= __('Product Id') ?><!--</th>-->
<!--                                <th>--><?php //= __('Product Quantity') ?><!--</th>-->
<!--                                <th>--><?php //= __('Subtotal') ?><!--</th>-->
<!--                                <th>--><?php //= __('Created') ?><!--</th>-->
<!--                                <th>--><?php //= __('Modified') ?><!--</th>-->
<!--                                <th class="actions">--><?php //= __('Actions') ?><!--</th>-->
<!--                            </tr>-->
<!--                            --><?php //foreach ($product->cart_products as $cartProduct) : ?>
<!--                                <tr>-->
<!--                                    <td>--><?php //= h($cartProduct->id) ?><!--</td>-->
<!--                                    <td>--><?php //= h($cartProduct->cart_id) ?><!--</td>-->
<!--                                    <td>--><?php //= h($cartProduct->product_id) ?><!--</td>-->
<!--                                    <td>--><?php //= h($cartProduct->product_quantity) ?><!--</td>-->
<!--                                    <td>--><?php //= h($cartProduct->subtotal) ?><!--</td>-->
<!--                                    <td>--><?php //= h($cartProduct->created) ?><!--</td>-->
<!--                                    <td>--><?php //= h($cartProduct->modified) ?><!--</td>-->
<!--                                    <td class="actions">-->
<!--                                        --><?php //= $this->Html->link(__('View'), ['controller' => 'CartProducts', 'action' => 'view', $cartProduct->id]) ?>
<!--                                        --><?php //= $this->Html->link(__('Edit'), ['controller' => 'CartProducts', 'action' => 'edit', $cartProduct->id]) ?>
<!--                                        --><?php //= $this->Form->postLink(
//                                            __('Delete'),
//                                            ['controller' => 'CartProducts', 'action' => 'delete', $cartProduct->id],
//                                            [
//                                                'method' => 'delete',
//                                                'confirm' => __('Are you sure you want to delete # {0}?', $cartProduct->id),
//                                            ]
//                                        ) ?>
<!--                                    </td>-->
<!--                                </tr>-->
<!--                            --><?php //endforeach; ?>
<!--                        </table>-->
<!--                    </div>-->
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
