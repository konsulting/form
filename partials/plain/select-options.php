<?php foreach($options as $option) : ?>
    <option value="<?= $option['value'] ?>"
        <?= isset($option['disabled']) ? 'disabled' : '' ?>
        <?= $element->isSelected($option['value']) ? 'selected' : '' ?>
    >
        <?= $option['name'] ?>
    </option>
<?php endforeach ?>
