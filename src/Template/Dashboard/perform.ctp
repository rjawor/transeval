<script>
jQuery.data(document.body, "current", 0);
</script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
Progress
</nav>
<div class="assignments index large-9 medium-8 columns content">
    <h4>Performing assignment: <?= $assignment->name ?></h4>
    <?php
    foreach ($assignment->inputs as $input) {
    ?>
        <div id="input<?=$input->pos?>" class="input-segment<?= $input->pos == 0 ? " selected":""?>">
            <div class="input-text">
                <?= $input->content?>
            </div>
            <div class="input-text-concordia">
                <?= $input->content?>
            </div>
            <div class="target-field">
                <input type="text" />
                <img class="button-image" src="/transeval/img/apply.png" onclick="next()" />
            </div>
            <div class="suggestions">
            
            </div>
            <hr/>
        </div>
    
    <?php
    
    }
    
    ?>

    <pre>
    <?php print_r($assignment); ?>
    </pre>
</div>


