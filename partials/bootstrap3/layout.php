<div class="field-wrapper">
    <?php /* PREPEND */ ?>
    <?php if ($element->prepend) : ?>
        <?= $element->prepend ?>
    <?php endif ?>

    <?php /* LABEL */ ?>
    <div class="form-group<?= $element->feedback ? ' has-' . $element->feedbackType : '' ?><?= $element->showFeedbackIcons ? ' has-feedback' : '' ?>">
        <?php if ($element->label) : ?>
            <label for="<?= $this->escape($element->getLabelFor()) ?>" class="control-label">
                <?= $this->escape($element->label) ?>

                <?php /* TOOLTIP */ ?>
                <?php if ($element->tooltip) : ?>
                    <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="bottom"
                       title="<?= $element->tooltip ?>" style="padding-left: 2px; cursor: pointer;"></i>
                <?php endif ?>

            </label>
        <?php endif ?>

        <?php /* ADDONS */ ?>
        <?php if ( ! $element->addons->isEmpty()) : ?>
            <div class="input-group">
                <?php foreach ($element->addons->where('position', 'before') as $addon) : ?>
                    <?= (string)$addon['content'] ?>
                <?php endforeach ?>
                <?= $this->section('content') ?>
                <?php foreach ($element->addons->where('position', 'after') as $addon) : ?>
                    <?= (string)$addon['content'] ?>
                <?php endforeach ?>
            </div>
        <?php else : ?>
            <?= $this->section('content') ?>
        <?php endif ?>

        <?php /* FEEDBACK */ ?>
        <?php if ($element->feedback) : ?>
            <div class="help-block">
                <?= $this->escape($element->feedback) ?>
            </div>
            <?= $this->insert('feedback-icons', ['element' => $element]) ?>
        <?php endif ?>

        <?php /* HELP */ ?>
        <?php if ($element->help) : ?>
            <div class="help-block help-block-plain">
                <?= $this->escape($element->help) ?>
            </div>
        <?php endif ?>
    </div>

    <?php /* APPEND */ ?>
    <?php if ($element->append) : ?>
        <?= $element->append ?>
    <?php endif ?>
</div>
