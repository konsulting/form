<?php $this->layout('layout-checkbox-radio', get_defined_vars()) ?>
<?php if($element->forceValue) : ?>
    <input type="hidden" name="<?= $this->escape($element->name) ?>" value="<?= $this->escape($element->forceValue) ?>">
<?php endif ?>
<input<?= $element->attributes() ?><?= $element->checked ? ' checked' : '' ?>>
