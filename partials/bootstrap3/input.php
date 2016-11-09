<?php if ($element->type != 'hidden') : ?>
    <?php $this->layout('layout', get_defined_vars()) ?>
<?php endif ?>
<?php if ($element->type != 'static') : ?>
    <input class="form-control <?= $element->attributes()->get('class') ?>"<?= $element->attributesExcept('class') ?>>
<?php else: ?>
    <p class="form-control-static" <?= $element->attributesExcept(['value', 'class']) ?>>
        <?= $element->attributes()->get('value') ?>
    </p>
<?php endif ?>
