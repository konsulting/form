<?php $this->layout('layout', get_defined_vars()) ?>

<?php if ($element->split == false) : ?>
    <input type="<?= $element->timeFormat() ?>"<?= $element->attributes() ?>>
<?php else : ?>
    <?php foreach ($element->getSplitValue() as $name => $value) : ?>
        <input type="text" name="<?= $this->escape($element->name) ?>[<?= $this->escape($name) ?>]" value="<?= $this->escape($value) ?>" placeholder="<?= $element->getSplitPlaceholders()[$name] ?>" maxlength="<?= strlen($element->getSplitPlaceholders()[$name]) ?>">
    <?php endforeach ?>
<?php endif ?>
