<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<section class="contact-form" id="login">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <?php $user = $this->request->getAttribute('identity'); ?>
            <h2>Welcome, <?= h($user->username) ?></h2>
            <p>Admin Dashboard</p>
            <div class="border"></div>
        </div>
    </div>

    <section class="user-dashboard page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div id="cf-submit" style="padding-bottom: 20px">
                        <?= $this->Html->link(__('Manage Products'),
                            ['controller' => 'Products', 'action' => 'index'],
                            ['class' => 'btn btn-primary', 'id' => 'contact-submit']) ?>
                    </div>

                    <div id="cf-submit" style="padding-bottom: 20px">
                        <?= $this->Html->link(__('Manage Messages'),
                            ['controller' => 'Messages', 'action' => 'index'],
                            ['class' => 'btn btn-primary', 'id' => 'contact-submit']) ?>
                    </div>

                    <div id="cf-submit" style="padding-bottom: 20px">
                        <?= $this->Html->link(__('Manage Suppliers'),
                            ['controller' => 'Suppliers', 'action' => 'index'],
                            ['class' => 'btn btn-primary', 'id' => 'contact-submit']) ?>
                    </div>

                    <div id="cf-submit" style="padding-bottom: 20px">
                        <?= $this->Html->link(__('Manage User Accounts'),
                            ['controller' => 'Users', 'action' => 'index'],
                            ['class' => 'btn btn-primary', 'id' => 'contact-submit']) ?>
                    </div>

                    <div id="cf-submit" style="padding-bottom: 20px">
                        <?= $this->Html->link(__('Edit FAQ Page'),
                            ['controller' => 'Pages', 'action' => 'faq'],
                            ['class' => 'btn btn-primary', 'id' => 'contact-submit']) ?>
                    </div>
                    <p>*To edit footer content, please navigate to the Home Page by clicking the logo in the top left corner and scroll down to the footer.</p>
                </div>
            </div>
        </div>
    </section>
</section>
