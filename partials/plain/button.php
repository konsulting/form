<?php $this->layout('layout', get_defined_vars()) ?>
<button<?= $element->attributes() ?>>
    <?= $element->text ? $this->escape($element->text) : 'No Text Provided' ?>
</button>
