<?php if($element->prepend) : ?>
    <?= $element->prepend ?>
<?php endif ?>

<label>
    <?= $this->section('content') ?>
    <?= $this->escape($element->label) ?>
</label>

<?php if($element->error) : ?>
    <div class="error">
        <?= $this->escape($element->error) ?>
    </div>
<?php endif ?>

<?php if($element->help) : ?>
    <div class="help">
        <?= $this->escape($element->help) ?>
    </div>
<?php endif ?>

<?php if($element->append) : ?>
    <?= $element->append ?>
<?php endif ?>
