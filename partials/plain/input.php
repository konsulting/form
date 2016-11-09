<?php if ($element->type != 'hidden') : ?>
    <?php $this->layout('layout', get_defined_vars()) ?>
<?php endif ?>
<?php if ($element->type != 'static') : ?>
    <input<?= $element->visibleAttributes()->escapedString() ?>>
<?php else: ?>
    <p class="input-static" <?= $element->visibleAttributes()->except(['value', 'class'])->escapedString() ?>>
        <?= $element->visibleAttributes()->get('value') ?>
    </p>
<?php endif ?>
