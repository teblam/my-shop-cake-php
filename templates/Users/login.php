<div class="users form content">
    <?= $this->Flash->render() ?>
    <h3>Connexion</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('email', ['label' => 'Email']) ?>
        <?= $this->Form->control('password', ['label' => 'Mot de passe']) ?>
    </fieldset>
    <?= $this->Form->button(__('Se connecter')); ?>
    <?= $this->Form->end() ?>
    
    <div class="actions">
        <?= $this->Html->link("S'inscrire", ['action' => 'register']) ?>
    </div>
</div> 