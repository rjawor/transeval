<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assignment'), ['action' => 'add']) ?>
        <li><?= $this->Html->link(__('List Assignments'), ['action' => 'config']) ?></li>
    </ul>
</nav>
<div class="assignments form large-9 medium-8 columns content">
    <?= $this->Form->create($assignment) ?>
    <fieldset>
        <legend><?= __('New Assignment') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
        <label for="inputs">Sentences to translate (one per line)</label>
        <textarea id="inputs" rows="20" name="inputs"></textarea>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
