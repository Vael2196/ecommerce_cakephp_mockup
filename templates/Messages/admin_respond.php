<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
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
        width: 100%;
        padding: 0.875rem 1.125rem;
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
</style>


<section class="contact-form" id="login">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>Respond to Message</h2>
            <p></p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('List of Messages'), ['controller'=> 'Messages','action' => 'index']) ?></p>
        </div>
    </div>
</section>

<div class="container-xl px-4 mt-4 card-body ">
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4" style="min-height: 300px;">
                <div class="card-header"> Your Response</div>
                <div class="card-body py-20">
                    <?= $this->Form->create($message) ?>

                    <?= $this->Form->create($message, ['class' => 'form-horizontal']) ?>
                    <?= $this->Form->control('response', [
                        'label' => false,
                        'class' => 'form-control',
                        'rows' => 5,
                        'maxlength' => 500,
                        'type' => 'textarea'
                    ]) ?>
                    <?= $this->Form->button(__('Send Response'), ['class' => 'btn btn-primary mt-3']) ?>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>



<!--<div class="container mt-4 my-text">-->
<!--    <h2 class="my-color">Respond to Message</h2>-->
<!--    --><?php //= $this->Form->create($message, ['class' => 'form-horizontal']) ?>
<!--    --><?php //= $this->Form->control('response', [
//        'label' => 'Your Response',
//        'class' => 'form-control',
//        'rows' => 5,
//        'type' => 'textarea'
//    ]) ?>
<!--    --><?php //= $this->Form->button(__('Send Response'), ['class' => 'btn btn-secondary mt-3']) ?>
<!--    --><?php //= $this->Form->end() ?>
<!--</div>-->
