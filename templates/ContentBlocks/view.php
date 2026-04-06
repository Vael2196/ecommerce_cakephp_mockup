<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContentBlock $contentBlock
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Content Block'), ['action' => 'edit', $contentBlock->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Content Block'), ['action' => 'delete', $contentBlock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlock->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Content Blocks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Content Block'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contentBlocks view content">
            <h3><?= h($contentBlock->label) ?></h3>
            <table>
                <tr>
                    <th><?= __('Page') ?></th>
                    <td><?= h($contentBlock->page) ?></td>
                </tr>
                <tr>
                    <th><?= __('Parent Content Block') ?></th>
                    <td><?= $contentBlock->hasValue('parent_content_block') ? $this->Html->link($contentBlock->parent_content_block->label, ['controller' => 'ContentBlocks', 'action' => 'view', $contentBlock->parent_content_block->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($contentBlock->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Label') ?></th>
                    <td><?= h($contentBlock->label) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contentBlock->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($contentBlock->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated') ?></th>
                    <td><?= h($contentBlock->updated) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Value') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($contentBlock->value)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Previous Value') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($contentBlock->previous_value)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Content Blocks') ?></h4>
                <?php if (!empty($contentBlock->child_content_blocks)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Page') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Label') ?></th>
                            <th><?= __('Value') ?></th>
                            <th><?= __('Previous Value') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Updated') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($contentBlock->child_content_blocks as $childContentBlock) : ?>
                        <tr>
                            <td><?= h($childContentBlock->id) ?></td>
                            <td><?= h($childContentBlock->page) ?></td>
                            <td><?= h($childContentBlock->parent_id) ?></td>
                            <td><?= h($childContentBlock->type) ?></td>
                            <td><?= h($childContentBlock->label) ?></td>
                            <td><?= h($childContentBlock->value) ?></td>
                            <td><?= h($childContentBlock->previous_value) ?></td>
                            <td><?= h($childContentBlock->created) ?></td>
                            <td><?= h($childContentBlock->updated) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ContentBlocks', 'action' => 'view', $childContentBlock->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ContentBlocks', 'action' => 'edit', $childContentBlock->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'ContentBlocks', 'action' => 'delete', $childContentBlock->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $childContentBlock->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>