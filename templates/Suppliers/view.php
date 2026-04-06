<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
?>

<section class="contact-form" id="">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>View Supplier </h2>
            <p>Details</p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('List of Suppliers'), ['controller'=> 'Suppliers','action' => 'index']) ?></p>
        </div>
    </div>
</section>

<div class="d-flex justify-content-center align-items-center" style="min-height: 40vh;">
    <div class="dashboard-wrapper dashboard-user-profile w-100">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-8">
                <!-- Supplier information table -->
                <div class="single-product-details">
                    <h3 style="color:darkred; padding-bottom: 20px">Supplier: <?= h($supplier->name) ?></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th><?= __('Name') ?></th>
                                <td><?= h($supplier->name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Email') ?></th>
                                <td><?= h($supplier->email) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <td><?= $this->Number->format($supplier->id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Created') ?></th>
                                <td><?= h($supplier->created) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Modified') ?></th>
                                <td><?= h($supplier->modified) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Related products') ?></th>
                                <td>
                                    <?php foreach ($supplier->products as $product) : ?>
<!--                                    --><?php //= h($product->product_name) ?>
<!--                                        --><?php //= $product->hasValue('product') ?
//                                            $this->Html->link($product->product->name, ['controller' => 'Products', 'action' => 'view', $product->product->id])
//                                            : '' ?>
                                    <?= $this->Html->link(h($product->product_name), ['controller' => 'Products', 'action' => 'view', $product->id]) ?><br>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplier->id], [
                    'class' => 'btn btn-warning btn-sm'
                ]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supplier->id], [
                    'method' => 'delete',
                    'confirm' => __('Are you sure you want to delete # {0}?', $supplier->id),
                    'class' => 'btn btn-danger btn-sm'
                ]) ?>
            </div>
        </div>
    </div>
</div>
