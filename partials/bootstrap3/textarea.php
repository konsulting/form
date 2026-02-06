<?php $this->layout('layout', get_defined_vars()) ?>
<textarea class="form-control <?= $this->escape($element->attributes()->get('class')) ?>"
    <?= $element->attributesExcept('class', 'value') ?>
    ><?= $this->escape($element->attributes()->get('value')) ?></textarea>
