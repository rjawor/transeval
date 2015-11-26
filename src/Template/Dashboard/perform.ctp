<nav class="large-3 medium-4 columns" id="actions-sidebar">
Progress
</nav>
<div class="assignments index large-9 medium-8 columns content">
    <h4>Performing assignment: <?= $assignment->name ?> <?= $concordia_enabled?"with":"without" ?> Concordia</h4>
    <?php
    foreach ($assignment->inputs as $input) {
    ?>
        <div id="input<?=$input->pos?>" class="input-segment<?= $input->pos == 0 ? " selected":""?><?= $concordia_enabled?" concordia":"" ?>">
            <div class="input-text">
                <?= $input->content?>
            </div>
            <div class="input-text-concordia">
            </div>
            <div class="target-field">
                <input type="text" />
                <button onclick="next()">Accept translation</button>
            </div>
            <div class="suggestions">
            </div>
            <hr/>
        </div>
    
    <?php
    
    }
    
    ?>    
</div>

<script>
    jQuery.data(document.body, "current", 0);
    initiateTranslation();
</script>

