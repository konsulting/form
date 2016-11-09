<?php if ($element->type != 'hidden') : ?>
    <?php $this->layout('layout', get_defined_vars()) ?>
<?php endif ?>
<?php if ($element->type != 'static') : ?>
    <input<?= $element->attributes() ?>>
<?php else: ?>
    <p class="input-static" <?= $element->attributesExcept(['value', 'class']) ?>>
        <?= $element->attributes('value') ?>
    </p>
<?php endif ?>
