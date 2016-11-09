<div class="field-wrapper">
    <?php if($element->prepend) : ?>
        <?= $element->prepend ?>
    <?php endif ?>

    <div class="form-group<?= $element->feedback ? ' has-' . $element->feedbackType  : ''?><?= $element->showFeedbackIcons ? ' has-feedback' : '' ?>">
        <?php if ($element->label) : ?>
            <label for="<?= $this->escape($element->getLabelFor()) ?>" class="control-label">
                <?= $this->escape($element->label) ?>
            </label>
        <?php endif ?>

        <?php if (! $element->addons->isEmpty()) : ?>
            <div class="input-group">
                <?php foreach($element->addons->where('position', 'before') as $addon) : ?>
                    <?= (string) $addon['content'] ?>
                <?php endforeach ?>
                <?= $this->section('content') ?>
                <?php foreach($element->addons->where('position', 'after') as $addon) : ?>
                    <?= (string) $addon['content'] ?>
                <?php endforeach ?>
            </div>
        <?php else : ?>
            <?= $this->section('content') ?>
        <?php endif ?>

        <?php if($element->feedback) : ?>
            <div class="help-block">
                <?= $this->escape($element->feedback) ?>
            </div>
            <?= $this->insert('feedback-icons', ['element' => $element]) ?>
        <?php endif ?>

        <?php if($element->help) : ?>
            <div class="help-block help-block-plain">
                <?= $this->escape($element->help) ?>
            </div>
        <?php endif ?>
    </div>

    <?php if($element->append) : ?>
        <?= $element->append ?>
    <?php endif ?>
</div>
