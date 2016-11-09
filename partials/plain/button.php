<?php $this->layout('layout', get_defined_vars()) ?>
<button<?= $element->visibleAttributes()->escapedString() ?>>
    <?= $element->text ? $this->escape($element->text) : 'No Text Provided' ?>
</button>
