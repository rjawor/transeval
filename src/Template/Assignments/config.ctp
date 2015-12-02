<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assignment'), ['action' => 'add']) ?>
        <li><?= $this->Html->link(__('List Assignments'), ['action' => 'config']) ?></li>
    </ul>
</nav>
<div class="assignments index large-9 medium-8 columns content">
    <h3><?= __('Configure assignments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th>Assigned users</th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment): ?>
            <tr>
                <td><a href="/transeval/assignments/view/<?= $assignment->id?>"><?= h($assignment->name) ?></a></td>
                <td><?= h($assignment->created) ?></td>
                <td><?= count($assignment->users) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Assign users'), ['action' => 'edit', $assignment->id]); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
