<?php $this->layout('layout', get_defined_vars()) ?>
<textarea<?= $element->visibleAttributes()->except(['value'])->escapedString() ?>><?= $element->visibleAttributes()->get('value') ?></textarea>
