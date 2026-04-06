<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<!--<div class="container">-->
<!---->
<!--                <h2 class="my-color">Login</h2>-->
<!--                <br>-->
<!--                <p class="my-text">Don't have an account?</p>-->
<!--                <p>--><?php //= $this->Html->link(__('Create an account here'), ['action' => 'register']) ?><!--</p>-->
<!---->
<!--                --><?php //= $this->Form->create() ?>
<!--                --><?php //= $this->Form->control('username', ['class' => 'form-control my-text text-start ', 'label' => ['text' => 'Username', 'class' => 'my-text']]) ?>
<!--                --><?php //= $this->Form->control('password', ['class' => 'form-control my-text text-start', 'label' => ['text' => 'Password', 'class' => 'my-text']])?>
<!--                <div class="mt-3">-->
<!--                    --><?php //= $this->Form->button('Login', ['class' => 'btn btn-primary']) ?>
<!--                </div>-->
<!--                --><?php //= $this->Form->end() ?>
<!---->
<!--</div>-->

<section class="contact-form" id="login">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center">
                    <h2>Login</h2>
                    <p>Welcome Back! </p>
                    <p style="font-weight: bold;"> You must be logged in to view your cart</p>
                    <div class="border"></div>
                </div>
            </div>
            <!-- /section title -->
        </div>

        <!-- Login -->
        <div class="row justify-content-center">
            <div class="col-md-6" style="padding-bottom: 100px;">
            <form id="contact-form" method="post" role="form>

                <?= $this->Form->create() ?>

                <div class="form-group mb-4">
                    <?= $this->Form->control('username', [
                        'type' => 'text',
                        'label' => false, // removes the default label
                        'placeholder' => 'Username',
                        'class' => 'form-control',
                        'required' => true,
                        'id' => 'username'
                    ]) ?>
                </div>

                <div class="form-group mb-4">
                    <?= $this->Form->control('password', [
                        'label' => false,
                        'placeholder' => 'Password',
                        'class' => 'form-control my-text text-start',
                        'required' => true,
                        'id' => 'password'
                    ]) ?>
                </div>

            <div id="cf-submit">
                <?= $this->Form->button(__('Login'), [
                    'type' => 'submit',
                    'id' => 'contact-submit',
                    'class' => 'btn btn-transparent'
                ]) ?>
            </div>

                <?= $this->Form->end() ?>
            </form>

            <p class="mt-20">Don't have an account?
                <?= $this->Html->link(__('Sign up here'), ['action' => 'register']) ?></p>
        </div>
        </div>
        <!-- End Login -->
</section>

