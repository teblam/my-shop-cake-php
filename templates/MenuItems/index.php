<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MenuItem> $menuItems
 */
?>
<div class="menuItems index content">
    <?= $this->Html->link(__('Generate from Controllers'), ['action' => 'generate'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('New Menu Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Menu Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('link') ?></th>
                    <th><?= $this->Paginator->sort('order') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuItems as $menuItem): ?>
                <tr>
                    <td><?= $this->Number->format($menuItem->id) ?></td>
                    <td><?= h($menuItem->title) ?></td>
                    <td><?= h($menuItem->link) ?></td>
                    <td><?= $this->Number->format($menuItem->order) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $menuItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menuItem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menuItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuItem->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>