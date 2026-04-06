<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<section class="contact-form" id="">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>View User </h2>
            <p>Details</p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('List of User Accounts'), ['controller'=> 'Users','action' => 'index']) ?></p>
        </div>
    </div>
</section>

<div class="d-flex justify-content-center align-items-center" style="min-height: 40vh;">
    <div class="dashboard-wrapper dashboard-user-profile w-100">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-8">
                <!-- User information table -->
                <div class="single-product-details">
                    <h3 style="color:darkred; padding-bottom: 20px"><?= h($user->username) ?></h3>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?= __('Username') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('User ID') ?></th>
                            <td><?= $this->Number->format($user->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($user->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($user->modified) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Role') ?></th>
                            <td><?= $user->role ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
                </div>
                </div>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], [
                    'class' => 'btn btn-warning btn-sm'
                ]) ?>
                <?php if ($user->role != 1): ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], [
                        'method' => 'delete',
                        'confirm' => __('Are you sure you want to delete # {0}?', $user->username),
                        'class' => 'btn btn-danger btn-sm'
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

