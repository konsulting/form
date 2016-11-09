<?php if($element->prepend) : ?>
    <?= $element->prepend ?>
<?php endif ?>

<?php if ($element->label) : ?>
    <label for="<?= $this->escape($element->id) ?>">
        <?= $this->escape($element->label) ?>
    </label>
<?php endif ?>

<?= $this->section('content') ?>

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
