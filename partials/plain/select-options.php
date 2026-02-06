<?php foreach($options as $option) : ?>
    <option value="<?= $this->escape($option['value']) ?>"
        <?= isset($option['disabled']) ? 'disabled' : '' ?>
        <?= $element->isSelected($option['value']) ? 'selected' : '' ?>
    >
        <?= $this->escape($option['name']) ?>
    </option>
<?php endforeach ?>
