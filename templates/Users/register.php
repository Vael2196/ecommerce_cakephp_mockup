<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!--<div class="users form content">-->
<!--    <h3 class="my-color">--><?php //= __('Register') ?><!--</h3>-->
<!--    --><?php //= $this->Form->create($user) ?>
<!--    <fieldset>-->
<!--        <p class="my-text">--><?php //= __('Create Your Account') ?><!--</p>-->
<!--        <br>-->
<!--        --><?php
//        echo $this->Form->control('username', ['class' => 'form-control my-text text-start ', 'label' => ['text' => 'Username', 'class' => 'my-text']]);
//        echo $this->Form->control('email', ['class' => 'form-control my-text text-start', 'label' => ['text' => 'Email', 'class' => 'my-text']]);
//        echo $this->Form->control('password', ['class' => 'form-control my-text text-start', 'label' => ['text' => 'Password', 'class' => 'my-text']]);
//        ?>
<!---->
<!--    </fieldset>-->
<!--    --><?php //= $this->Form->button(__('Register'), ['class' => 'btn btn-primary']) ?>
<!--    --><?php //= $this->Form->end() ?>
<!--    <p>--><?php //= $this->Html->link(__('Already have an account? Log in'), ['action' => 'login']) ?><!--</p>-->
<!--</div>-->

<section class="contact-form" id="login">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>Register</h2>
            <p>Join the CrunchyCraving Family</p>
            <div class="border"></div>
        </div>
    </div>

    <!-- Login -->
    <div class="row justify-content-center">
        <div class="col-md-6" style="padding-bottom: 60px;">
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
            <?= $this->Form->control('email', [
                'type' => 'email',
                'label' => false,
                'placeholder' => 'Email',
                'class' => 'form-control my-text text-start',
                'required' => true,
                'id' => 'email'
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

<!--        <div id="cf-submit">-->
<!--            --><?php //= $this->Form->button(__('Register'), [
//                'type' => 'submit',
//                'class' => 'btn btn-primary btn-block',
//            ]) ?>
<!--        </div>-->

        <div id="cf-submit">
            <?= $this->Form->button(__('Register'), [
                'type' => 'submit',
                'id' => 'contact-submit',
                'class' => 'btn btn-transparent'
            ]) ?>
        </div>

        <?= $this->Form->end() ?>

        <p class="mt-20">Already have an account?
            <?= $this->Html->link(__('Login'), ['action' => 'login']) ?></p>
    </div>

    <!-- End Login -->
</section>
