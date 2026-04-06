<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>

<section class="contact-form" id="login">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>Products</h2>
            <p>View and manage all products</p>
            <div class="border"></div>
            <p class="mt-20">&#8592;  <?= $this->Html->link(__('Dashboard'), ['controller'=> 'Users','action' => 'dashboard']) ?></p>
        </div>
    </div>
</section>

<div class="d-flex justify-content-between mb-3">
    <!-- New Product button on the left -->
    <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'btn btn-success']) ?>

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

<div class="table-responsive my-text">
    <table class="table index-table">
<!--        <thead>-->
<!--        <tr class="my-text">-->
<!--            <th>ID</th>-->
<!--            <th>Supplier</th>-->
<!--            <th>Product Name</th>-->
<!--            <th>Type</th>-->
<!--            <th>Price</th>-->
<!--            <th>Quantity</th>-->
<!--            <th>Created</th>-->
<!--            <th>Modified</th>-->
<!--            <th class="actions">Actions</th>-->
<!--        </tr>-->
<!--        </thead>-->

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
        <tr>
            <th><?= $this->Paginator->sort('id', 'ID' . $renderSortIcon('id')) ?></th>
            <th><?= $this->Paginator->sort('supplier_id', 'Supplier' . $renderSortIcon('supplier_id')) ?></th>
            <th><?= $this->Paginator->sort('product_name', 'Product Name' . $renderSortIcon('product_name')) ?></th>
            <th><?= $this->Paginator->sort('product_type', 'Type' . $renderSortIcon('product_type')) ?></th>
            <th><?= $this->Paginator->sort('price', 'Price' . $renderSortIcon('price')) ?></th>
            <th><?= $this->Paginator->sort('quantity', 'Qty' . $renderSortIcon('quantity')) ?></th>
            <th><?= $this->Paginator->sort('created', 'Created' . $renderSortIcon('created')) ?></th>
            <th><?= $this->Paginator->sort('modified', 'Modified' . $renderSortIcon('modified')) ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>



        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td>
                    <?= $product->hasValue('supplier') ?
                        $this->Html->link($product->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $product->supplier->id])
                        : '' ?>
                </td>
                <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <?= h($product->product_name) ?></td>
                <td><?= h($product->product_type) ?></td>
                <td><?= $this->Number->format($product->price) ?></td>
                <td><?= $this->Number->format($product->quantity) ?></td>
                <td><?php $time = $product->created; echo $time->nice('Australia/Melbourne',"en-EN") ?></td>
                <td><?php $time = $product->modified; echo $time->nice('Australia/Melbourne',"en-EN") ?></td>
                <td class="actions d-flex gap-2">
                    <div>
                        <?= $this->Html->link(__('View'), ['action' => 'view', $product->id], [
                            'class' => 'btn btn-primary btn-sm'
                        ]) ?>
                    </div>
                    <div>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], [
                            'class' => 'btn btn-warning btn-sm'
                        ]) ?>
                    </div>
                    <div>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], [
                            'method' => 'delete',
                            'confirm' => __('Are you sure you want to delete # {0}?', $product->id),
                            'class' => 'btn btn-danger btn-sm'
                        ]) ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!--<div class="paginator my-text">-->
<!--    <ul class="pagination">-->
<!--        --><?php //= $this->Paginator->first('<<', ['tag' => 'li', 'class' => 'page-item mx-1']) ?>
<!--        --><?php //= $this->Paginator->prev(' < ' . __('previous'),['class' => 'page-link mx-1']) ?>
<!--        --><?php //= $this->Paginator->numbers(['class' => 'page-link mx-1']) ?>
<!--        --><?php //= $this->Paginator->next(__('next') . ' > ',['class' => 'page-link mx-1']) ?>
<!--        --><?php //= $this->Paginator->last(__('last') . ' >> ',['class' => 'page-link mx-1']) ?>
<!--    </ul>-->
<!--    <p>--><?php //= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?><!--</p>-->
<!--</div>-->

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

