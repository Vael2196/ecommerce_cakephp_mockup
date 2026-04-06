<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
?>

<div class="container px-4 px-lg-5">
    <h2 class="my-color">Add Message </h2>
        <div class="d-flex justify-content-end mb-3">
            <?= $this->Html->link(__('View Messages'), ['action' => 'index'], ['class' => 'side-nav-item btn btn-secondary']) ?>
        </div>
    <div class="row gx-0 ">
        <div class="my-text left">
            <div class="messages form content">
                <?= $this->Form->create($message) ?>
                <fieldset>
<!--                    <legend>--><?php //= __('Add Message') ?><!--</legend>-->
                    <?php
                    echo $this->Form->control('name', ['class' => 'form-control my-text text-start ', 'label' => 'Name']);
                    echo $this->Form->control('email', ['class' => 'form-control my-text text-start ', 'label' => 'Email']);
                    echo $this->Form->control('subject', ['class' => 'form-control my-text text-start ', 'label' => 'Subject']);
                    echo $this->Form->control('message', ['class' => 'form-control my-text text-start ', 'label' => 'Message']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>


    </div>

</div>

