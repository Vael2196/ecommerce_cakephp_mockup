<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Message> $messages
 */
?>



<section class="contact-form" id="login">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>Messages</h2>
            <p>View and manage customer enquiries</p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('Dashboard'), ['controller'=> 'Users','action' => 'dashboard']) ?></p>
        </div>
    </div>
</section>

<!-- Sort by dropdown on the right -->
<div class="d-flex justify-content-end">
    <div class="d-flex align-items-center" style="gap: 10px;">
        <p class="mb-0">Sort order by clicking on row headers</p>
    </div>
</div>



<div class="total-order mt-20">
    <div class="table-responsive">
        <table class="table">

<!--            <thead>-->
<!--            <tr class="my-text">-->
<!--                <th>Name</th>-->
<!--                <th>Email</th>-->
<!--                <th>Subject</th>-->
<!--                <th>Preview</th>-->
<!--                <th>Responded?</th>-->
<!--                <th>Reply</th>-->
<!--                <th>Created</th>-->
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
                <th><?= $this->Paginator->sort('name', 'Name' . $renderSortIcon('name')) ?></th>
                <th><?= $this->Paginator->sort('email', 'Email' . $renderSortIcon('email')) ?></th>
                <th><?= $this->Paginator->sort('subject', 'Subject' . $renderSortIcon('subject')) ?></th>
                <th><?= $this->Paginator->sort('preview', 'Preview' . $renderSortIcon('preview')) ?></th>
                <th><?= $this->Paginator->sort('responded', 'Reply?' . $renderSortIcon('responded')) ?></th>
                <th><?= $this->Paginator->sort('response', 'Response' . $renderSortIcon('responded')) ?></th>
                <th><?= $this->Paginator->sort('created', 'Created' . $renderSortIcon('created')) ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </thead>



            <tbody>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <!--                    <td>--><?php //= $this->Number->format($message->id) ?><!--</td>-->
                    <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?= h($message->name) ?></td>
                    <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?= h($message->email) ?></td>
                    <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?= h($message->subject) ?></td>
                    <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?php
                        $brief = $message->message;
                        echo h((strlen($brief) > 30 ? substr($brief, 0, 30) . '...' : $brief));
                        ?>
                    </td>
                    <td><?= $message->responded ? __('Yes') : __('No') ?></td>
                    <td>
                        <?php
                        $responseText = $message->response;
                        echo $responseText ? h((strlen($responseText) > 30 ? substr($responseText, 0, 30) . '...' : $responseText)) : __('N/A');
                        ?>
                    </td>
                    <td><?php $time = $message->created;
                        echo $time->nice('Australia/Melbourne',"en-EN")
                        ?></td>

                    <td class="actions">
                        <div class="d-flex gap-2 flex-wrap">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $message->id], [
                                'class' => 'btn btn-primary btn-sm'
                            ]) ?>
                            <?= $this->Html->link(__('Respond'), ['action' => 'adminRespond', $message->id], [
                                'class' => 'btn btn-warning btn-sm'
                            ]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->id], [
                                'method' => 'post',
                                'confirm' => __('Are you sure you want to delete # {0}?', $message->id),
                                'class' => 'btn btn-danger btn-sm'
                            ]) ?>
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
