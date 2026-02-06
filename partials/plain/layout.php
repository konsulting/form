<div class="field-wrapper">
    <?php if($element->prepend) : ?>
        <?= $this->escape($element->prepend) ?>
    <?php endif ?>

    <?php if ($element->label) : ?>
        <label for="<?= $this->escape($element->id) ?>">
            <?= $this->escape($element->label) ?>
        </label>
    <?php endif ?>

    <?php if (! $element->addons->isEmpty()) : ?>
        <div class="input-group">
            <?php foreach($element->addons->where('position', 'before') as $addon) : ?>
                <?= $this->escape((string) $addon['content']) ?>
            <?php endforeach ?>
            <?= $this->section('content') ?>
            <?php foreach($element->addons->where('position', 'after') as $addon) : ?>
                <?= $this->escape((string) $addon['content']) ?>
            <?php endforeach ?>
        </div>
    <?php else : ?>
        <?= $this->section('content') ?>
    <?php endif ?>

    <?php if($element->feedback) : ?>
        <div class="feedback-<?= $this->escape($element->feedbackType) ?>">
            <?= $this->escape($element->feedback) ?>
        </div>
    <?php endif ?>

    <?php if($element->help) : ?>
        <div class="help">
            <?= $this->escape($element->help) ?>
        </div>
    <?php endif ?>

    <?php if($element->append) : ?>
        <?= $this->escape($element->append) ?>
    <?php endif ?>
</div>
