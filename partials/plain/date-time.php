<?php $this->layout('layout', get_defined_vars()) ?>

<?php if ($element->split == false) : ?>
    <input type="<?= $element->timeFormat() ?>"<?= $element->attributes() ?>>
<?php else : ?>
    <?php $count = 0 ?>
    <?php foreach ($element->getSplitValue() as $name => $value) : ?>
        <?php $count++ ?>
        <input type="text" id="<?= $this->escape($element->id) . ($count == 1 ? '' : '_' . $count) ?>" name="<?= $this->escape($element->name) ?>[<?= $this->escape($name) ?>]" value="<?= $this->escape($value) ?>" placeholder="<?= $this->escape($element->getSplitPlaceholders()[$name]) ?>" maxlength="<?= strlen($element->getSplitPlaceholders()[$name]) ?>">
    <?php endforeach ?>
<?php endif ?>
