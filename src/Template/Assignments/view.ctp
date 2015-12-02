<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assignment'), ['action' => 'add']) ?>
        <li><?= $this->Html->link(__('List Assignments'), ['action' => 'config']) ?></li>
    </ul>
</nav>
<div class="assignments view large-9 medium-8 columns content">
    <h3><?= h($assignment->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($assignment->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Database id') ?></th>
            <td><?= $this->Number->format($assignment->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Sentences') ?></th>
            <td><?= $this->Number->format(count($assignment->inputs)) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Sentences') ?></h4>
        <?php if (!empty($assignment->inputs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th width="10%">Position</th>
                <th>Content</th>
            </tr>
            <?php foreach ($assignment->inputs as $input): ?>
            <tr>
                <td><?= h($input->pos) ?></td>
                <td><?= h($input->content) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
