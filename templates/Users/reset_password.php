<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Retour'), ['action' => 'view', $user->id], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <h3><?= __('Réinitialisation du mot de passe pour ') . h($user->email) ?></h3>
            <?= $this->Form->create() ?>
            <fieldset>
                <?= $this->Form->control('password', [
                    'type' => 'password',
                    'label' => 'Nouveau mot de passe',
                    'required' => true
                ]) ?>
            </fieldset>
            <?= $this->Form->button(__('Valider')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>