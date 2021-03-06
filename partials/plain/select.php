<?php $this->layout('layout', get_defined_vars()) ?>
<select<?= $element->attributes() ?>>
    <?php if ($element->isGrouped()) : ?>
        <?php foreach($element->options() as $group => $options) : ?>
            <optgroup label="<?= $group ?>">
                <?= $this->insert('select-options', ['options' => $options, 'element' => $element]) ?>
            </optgroup>
        <?php endforeach ?>
    <?php else: ?>
        <?= $this->insert('select-options', ['options' => $element->options(), 'element' => $element]) ?>
    <?php endif ?>
</select>
