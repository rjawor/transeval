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
        <legend>Assign users to assignment: <?= $assignment->name?></legend>
        <p>
        Assignment will be assigned to all the users. Select from the list below the users who will be able to use Concordia.
        </p>
        <?php
            echo $this->Form->input('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
