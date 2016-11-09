<?php $this->layout('layout', get_defined_vars()) ?>
<button class="btn btn-default <?= $element->attributes()->get('class') ?>"<?= $element->attributesExcept('class') ?>>
    <?= $element->text ? $this->escape($element->text) : ucfirst($element->type) ?>
</button>
