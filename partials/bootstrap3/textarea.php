<?php $this->layout('layout', get_defined_vars()) ?>
<textarea class="form-control <?= $element->attributes()->get('class') ?>"
    <?= $element->attributesExcept('class', 'value') ?>
    ><?= $element->attributes()->get('value') ?></textarea>
