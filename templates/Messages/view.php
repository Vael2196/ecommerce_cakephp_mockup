<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
?>

<section class="contact-form" id="">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>View Message/Enquiry </h2>
            <p>Details</p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('List of Messages'), ['controller'=> 'Messages','action' => 'index']) ?></p>
        </div>
    </div>
</section>

<div class="d-flex justify-content-center align-items-center" style="min-height: 40vh;">
    <div class="dashboard-wrapper dashboard-user-profile w-100">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-8">
                <!-- Message information table -->
                <div class="single-product-details">
                    <h3 style="color:darkred; padding-bottom: 20px">Subject: <?= h($message->subject) ?></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th><?= __('Name') ?></th>
                                <td><?= h($message->name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Email') ?></th>
                                <td><?= h($message->email) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Subject') ?></th>
                                <td><?= h($message->subject) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Message/Enquiry') ?></th>
                                <td style="
                                white-space: normal;
                                overflow-wrap: break-word;
                                word-break: break-all;
                                ">
                                    <?= $this->Text->autoParagraph(h($message->message)); ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= __('Response given?') ?></th>
                                <td><?= $message->responded ? __('Yes') : __('No') ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Response Message') ?></th>
                                <td>
                                    <?= $message->response ? nl2br(h($message->response)) : __('No response yet') ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= __('Message ID') ?></th>
                                <td><?= $this->Number->format($message->id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Created') ?></th>
                                <td><?= h($message->created) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
<!--                --><?php //= $this->Html->link(__('Edit'), ['action' => 'edit', $message->id], [
//                    'class' => 'btn btn-warning btn-sm'
//                ]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->id], [
                    'method' => 'delete',
                    'confirm' => __('Are you sure you want to delete # {0}?', $message->id),
                    'class' => 'btn btn-danger btn-sm'
                ]) ?>
                <?= $this->Html->link(__('Respond to Message'),
                        ['action' => 'adminRespond', $message->id], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
        </div>
    </div>
</div>
