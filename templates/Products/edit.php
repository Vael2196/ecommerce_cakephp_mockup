<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var string[]|\Cake\Collection\CollectionInterface $suppliers
 */
?>

<style>
    body{margin-top:20px;
        background-color:#f2f6fc;
        color:#69707a;
    }
    .img-account-profile {
        height: 10rem;
    }
    .rounded-circle {
        border-radius: 50% !important;
    }
    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
    }
    .card .card-header {
        font-weight: 500;
    }
    .card-header:first-child {
        border-radius: 0.35rem 0.35rem 0 0;
    }
    .card-header {
        padding: 1rem 1.35rem;
        margin-bottom: 0;
        background-color: rgba(33, 40, 50, 0.03);
        border-bottom: 1px solid rgba(33, 40, 50, 0.125);
    }
    .form-control, .dataTable-input {
        display: block;
        /*width: 100%;*/
        /*padding: 0.875rem 1.125rem;*/
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1;
        color: #69707a;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #c5ccd6;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.35rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .custom-dropdown {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='gray' class='bi bi-caret-down-fill' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658c-.566-.634-.106-1.658.753-1.658h9.592c.86 0 1.32 1.024.753 1.658l-4.796 5.482a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: 100% center;
        background-size: 1em;
        padding-right: 2.5rem;
        cursor: pointer;
    }
    .form-control,
    .custom-dropdown {
        box-sizing: border-box;
    }

</style>


<section class="contact-form" id="login">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>Edit Product</h2>
            <p></p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('List of Products'), ['controller'=> 'Products','action' => 'index']) ?></p>
        </div>
    </div>
</section>

<div class="container px-4 mt-4 ">
    <div class="row justify-content-center">
        <div class="col-lg-4 mb-4">
            <!-- Product image card-->
            <div class="card h-100">
                <div class="card-header">Product Image</div>
                <div class="card-body text-center">
                    <?php if (!empty($product->image)): ?>
                        <?= $this->Html->image('products/' . $product->image . '?t=' . time(), [
                            'alt' => h($product->product_name),
                            'class' => 'card-img-top product-image'
                        ]) ?>
                    <?php else: ?>
                        <?= $this->Html->image('image-not-found.jpg', [
                            'alt' => 'Product Image',
                            'class' => 'card-img-top product-image'
                        ]) ?>
                    <?php endif; ?>

                    <!-- Allow for new product image -->
                    <div class="mb-3" style="padding-top: 20px">
                        <?= $this->Form->create($product, ['type' => 'file']) ?>
                        <?= $this->Form->control('image', [
                            'type' => 'file',
                            'label' => 'Change image',
                            'class' => 'form-control-file',
                            'accept' => 'image/jpeg,image/png,image/webp,image/jpg'
                        ]) ?>
                    </div>
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">Only JPG, PNG, or WebP image files are allowed.</div>

                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4" style="height: 37rem;" >
                <div class="card-header"> Edit Product Details</div>
                <div class="card-body py-4 clearfix">
                    <?= $this->Form->create($product, ['type' => 'file']) ?>
                    <div class="row gx-3 mb-3">
                        <!-- Supplier-->
                        <div class="col-md-6">
                            <?= $this->Form->control('supplier_id', [
                                'options' => $suppliers,
                                'empty' => true,
                                'label' => ['class' => 'small mb-1', 'text' => 'Supplier'],
                                'class' => 'form-control custom-dropdown'
                            ]) ?>
                        </div>
                        <!-- Product Type -->
                        <div class="col-md-6">
                            <?= $this->Form->control('product_type', [
                                'type' => 'select',
                                'options' => ['Crackers' => 'Crackers', 'Hampers' => 'Hampers', 'Boards' => 'Charcuterie Boards'],
                                'empty' => true,
                                'label' => ['class' => 'small mb-1', 'text' => 'Product Type'],
                                'class' => 'form-control custom-dropdown'
                            ]) ?>
                        </div>
                    </div>

                    <!-- PRODUCT NAME -->
                    <div class="mb-3">
                        <?= $this->Form->control('product_name', [
                            'label' => ['class' => 'small mb-1', 'text' => 'Product Name'],
                            'class' => 'form-control'
                        ]) ?>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <?= $this->Form->control('product_description', [
                            'label' => ['class' => 'small mb-1', 'text' => 'Description'],
                            'maxlength' => 100,
                            'class' => 'form-control'
                        ]) ?>
                    </div>

                    <div class="row gx-3 mb-3">
                        <!-- Price -->
                        <div class="col-md-6">
                            <?= $this->Form->control('price', [
                                'min' => 0,
                                'label' => ['class' => 'small mb-1', 'text' => 'Price ($AUD)'],
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                        <!-- Quantity -->
                        <div class="col-md-6">
                            <?= $this->Form->control('quantity', [
                                'min' => 0,
                                'label' => ['class' => 'small mb-1', 'text' => 'Quantity'],
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                    </div>

                    <!-- Save button -->
                    <div class="mb-3 py-3">
                        <?= $this->Html->tag(
                            'button',
                            '<i class="fas fa-save"></i> Save changes', [
                                'type' => 'submit',
                                'class' => 'btn btn-primary w-100',
                                'escape' => false
                            ]
                        ) ?>
                    </div>
                    <?= $this->Form->end() ?>

                    <!-- Delete product button -->
                    <div class="mb-3 ">
                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash-alt"></i> Delete Product',
                            ['action' => 'delete', $product->id],
                            ['confirm' => __('Are you sure you want to delete this product?', $product->id),
                                'method' => 'delete',
                                'class' => 'btn btn-danger w-100',
                                'escape' => false]
                        ) ?>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>



