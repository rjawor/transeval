<nav class="large-3 medium-4 columns" id="actions-sidebar">
</nav>
<div class="assignments index large-9 medium-8 columns content">
    <h3><?= __('My assignments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th>Completed</th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment): ?>
            <tr>
                <td><?= h($assignment->name) ?></td>
                <td><?= h($assignment->created) ?></td>
                <td><?= $assignment["_matchingData"]["UsersAssignments"]->completed ? "<img src='/transeval/img/apply.png' />":"" ?></td>
                <td class="actions">
                    <?php
                        if (!$assignment["_matchingData"]["UsersAssignments"]->completed) {
                            echo $this->Html->link(__('Perform'), ['controller' => 'dashboard', 'action' => 'perform', $assignment->id]);
                        }
                    ?>
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
