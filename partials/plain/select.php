<?php $this->layout('layout', get_defined_vars()) ?>
<select<?= $element->visibleAttributes()->escapedString() ?>>
    <?php if($element->isGrouped()) : ?>
        <?php foreach($element->options() as $group => $options) : ?>
            <optgroup label="">
                <?= $this->insert('select-options', ['options' => $options, 'element' => $element]) ?>
            </optgroup>
        <?php endforeach ?>
    <?php else: ?>
        <?= $this->insert('select-options', ['options' => $element->options(), 'element' => $element]) ?>
    <?php endif ?>
</select>
