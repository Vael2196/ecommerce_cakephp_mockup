<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>

<section class="contact-form" id="users-index">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>User Accounts</h2>
            <p>View and manage user accounts</p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('Dashboard'), ['controller'=> 'Users','action' => 'dashboard']) ?></p>
        </div>
    </div>
</section>

<div class="d-flex justify-content-between mb-3">
    <!-- New User button on the left -->
    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'btn btn-success']) ?>

    <!-- Sort by dropdown on the right -->
    <div class="d-flex align-items-center" style="gap: 10px;">
        <p> Sort order by clicking on row headers </p>
        <!--        --><?php //= $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']) ?>
        <!--        --><?php //= $this->Form->control('direction', [
        //            'type' => 'select',
        //            'options' => ['asc' => 'Ascending', 'desc' => 'Descending'],
        //            'label' => false,
        //            'empty' => 'Sort Order',
        //            'class' => 'form-control mr-2'
        //        ]) ?>
        <!--        --><?php //= $this->Form->submit('Sort', ['class' => 'btn btn-secondary']) ?>
        <!--        --><?php //= $this->Form->end() ?>
    </div>
</div>



<div class="total-order mt-20">
    <div class="table-responsive">
        <table class="table">

<!--            <thead>-->
<!--            <tr>-->
<!--                <th>--><?php //= $this->Paginator->sort('username') ?><!--</th>-->
<!--                <th>--><?php //= $this->Paginator->sort('email') ?><!--</th>-->
<!--                <th>--><?php //= $this->Paginator->sort('role') ?><!--</th>-->
<!--                <th>--><?php //= $this->Paginator->sort('created') ?><!--</th>-->
<!--                <th>--><?php //= $this->Paginator->sort('modified') ?><!--</th>-->
<!--                <th class="actions">--><?php //= __('Actions') ?><!--</th>-->
<!--            </tr>-->
<!--            </thead>-->

<!--            <thead>-->
<!--            <tr class="my-text">-->
<!--                <th>Username</th>-->
<!--                <th>Email</th>-->
<!--                <th>Role</th>-->
<!--                <th>Created</th>-->
<!--                <th>Modified</th>-->
<!--                <th class="actions">Actions</th>-->
<!--            </tr>-->
<!--            </thead>-->

            <?php
            // Get current sort field and direction
            $currentSort = $this->request->getQuery('sort');
            $currentDirection = $this->request->getQuery('direction') ?? 'asc';

            $renderSortIcon = function ($field) use ($currentSort, $currentDirection) {
                // Determine next direction if user clicks this column
                $nextDirection = 'asc'; // default next direction
                if ($currentSort === $field) {
                    // If currently sorted asc, next will be desc, else asc
                    $nextDirection = ($currentDirection === 'asc') ? 'desc' : 'asc';
                }
                // Show arrow for sorting
                return $arrow = $nextDirection === 'asc' ? '▲' : '▼';
            };
            ?>

            <thead>
            <tr class="my-text">
                <th><?= $this->Paginator->sort('username', 'Username' . $renderSortIcon('username')) ?></th>
                <th><?= $this->Paginator->sort('email', 'Email' . $renderSortIcon('email')) ?></th>
                <th><?= $this->Paginator->sort('role', 'Role' . $renderSortIcon('role')) ?></th>
                <th><?= $this->Paginator->sort('created', 'Created' . $renderSortIcon('created')) ?></th>
                <th><?= $this->Paginator->sort('modified', 'Modified' . $renderSortIcon('modified')) ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= h($user->username) ?></td>
                    <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?= h($user->email) ?></td>
                    <td><?= $user->role ? __('Admin') : __('User') ?></td>
                    <td><?php $time = $user->created; echo $time->nice('Australia/Melbourne',"en-EN") ?></td>
                    <td><?php $time = $user->modified; echo $time->nice('Australia/Melbourne',"en-EN") ?></td>
                    <td class="actions">
                        <div class="d-flex gap-2 flex-wrap">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-warning btn-sm']) ?>
                            <?php if ($user->role != 1): ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], [
                                    'method' => 'delete',
                                    'confirm' => __('Are you sure you want to delete # {0}?', $user->username),
                                    'class' => 'btn btn-danger btn-sm'
                                ]) ?>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="paginator my-text d-flex flex-column align-items-center">
    <ul class="pagination justify-content-center">
        <li class="page-item mx-2"><?= $this->Paginator->first('<<', ['class' => 'page-link']) ?></li>
        <li class="page-item mx-2"><?= $this->Paginator->prev('< ' . __('previous'), ['class' => 'page-link']) ?></li>
        <!--        --><?php //= $this->Paginator->numbers([
        //            'before' => '',
        //            'after' => '',
        //            'separator' => '',
        //            'tag' => 'li',
        //            'currentClass' => 'active',
        //            'class' => 'page-item mx-2',
        //            'linkClass' => 'page-link'
        //        ]) ?>
        <li class="page-item mx-2"><?= $this->Paginator->next(__('next') . ' >', ['class' => 'page-link']) ?></li>
        <li class="page-item mx-2"><?= $this->Paginator->last('>>', ['class' => 'page-link']) ?></li>
    </ul>

    <p class="mt-2 text-center">
        <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
    </p>
</div>
