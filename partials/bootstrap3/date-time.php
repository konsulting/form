<?php $this->layout('layout', get_defined_vars()) ?>

<?php if ($element->plain == true) : ?>
    <input type="<?= $element->timeFormat() ?>" class="form-control <?= $element->attributes()->get('class') ?>"<?= $element->attributesExcept('class') ?>>
<?php elseif ($element->split == false) : ?>
    <div class="input-group <?= $element->timeFormat() ?>-picker">
        <input type="text" class="form-control <?= $element->attributes()->get('class') ?>"<?= $element->attributesExcept('class') ?>>
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-<?= $element->timeFormat() == 'time' ? 'time' : 'calendar' ?>"></span>
        </span>
    </div>
<?php else : ?>
    <div class="split-date">
        <?php
            $split = $element->getSplitValue();
            $count = 0;
        ?>
        <?php foreach ($split as $name => $value) :
            $count ++;
                ?><input
            type="text"
            name="<?= $this->escape($element->name) ?>[<?= $this->escape($name) ?>]"
            value="<?= $this->escape($value) ?>"
            placeholder="<?= $element->getSplitPlaceholders()[$name] ?>"
            maxlength="<?= strlen($element->getSplitPlaceholders()[$name]) ?>"
            class="form-control" id="<?= $element->attributes()->get('id') . '-' . $count ?>"
            style="width: <?= 100 / count($split) ?>%; display: inline-block"
            ><?php endforeach ?>
    </div>
    <input type="hidden" id="combined__<?= $this->escape($element->name) ?>">
<?php endif ?>
