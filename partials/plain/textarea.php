<?php $this->layout('layout', get_defined_vars()) ?>
<textarea<?= $element->attributesExcept('value') ?>><?= $this->escape($element->attributes()->get('value')) ?></textarea>
