<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuItem $menuItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $menuItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $menuItem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Menu Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuItems form content">
            <?= $this->Form->create($menuItem) ?>
            <fieldset>
                <legend><?= __('Edit Menu Item') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('link');
                    echo $this->Form->control('order');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
