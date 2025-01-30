<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Retour à la liste'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuItems form content">
            <h3><?= __('Générer depuis un contrôleur') ?></h3>
            <?= $this->Form->create() ?>
            <fieldset>
                <?= $this->Form->control('controller', [
                    'label' => 'Contrôleur',
                    'options' => $controllers,
                    'empty' => 'Choisir un contrôleur',
                    'required' => true,
                    'id' => 'controller'
                ]) ?>
                
                <?= $this->Form->control('action', [
                    'label' => 'Action',
                    'empty' => 'Choisir une action',
                    'required' => true,
                    'id' => 'action'
                ]) ?>
            </fieldset>
            <?= $this->Form->button(__('Générer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?php $this->append('script'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const controllerSelect = document.getElementById('controller');
    const actionSelect = document.getElementById('action');
    const actionsData = <?= json_encode($controllerActions) ?>;

    controllerSelect.addEventListener('change', function() {
        actionSelect.innerHTML = '<option value="">Choisir une action</option>';
        const actions = actionsData[this.value];
        
        actions.forEach(action => {
            const option = document.createElement('option');
            option.value = action;
            option.textContent = action;
            actionSelect.appendChild(option);
        });
    });
});
</script>
<?php $this->end(); ?>