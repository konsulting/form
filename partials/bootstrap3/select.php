<?php $this->layout('layout', get_defined_vars()) ?>
<select class="form-control <?= $this->escape($element->attributes()->get('class')) ?>"<?= $element->attributesExcept('class') ?>>
    <?php if ($element->isGrouped()) : ?>
        <?php foreach($element->options() as $group => $options) : ?>
            <optgroup label="<?= $this->escape($group) ?>">
                <?= $this->insert('select-options', ['options' => $options, 'element' => $element]) ?>
            </optgroup>
        <?php endforeach ?>
    <?php else: ?>
        <?= $this->insert('select-options', ['options' => $element->options(), 'element' => $element]) ?>
    <?php endif ?>
</select>
