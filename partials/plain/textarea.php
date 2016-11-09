<?php $this->layout('layout', get_defined_vars()) ?>
<textarea<?= $element->attributesExcept('value') ?>><?= $element->attributes()->get('value') ?></textarea>
