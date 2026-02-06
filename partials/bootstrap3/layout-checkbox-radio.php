<div class="field-wrapper">
    <?php if ($element->prepend) : ?>
        <?= $this->escape($element->prepend) ?>
    <?php endif ?>

    <?php if ($element->feedback): ?>
        <div class="has-<?= $this->escape($element->feedbackType) ?><?= $element->showFeedbackIcons ? ' has-feedback' : '' ?>">
    <?php endif ?>

        <?php if ($element->builder() && $element->builder()->isHorizontal()) : ?>
            <div class="<?= $element->builder()->horizontalClass('checkbox') ?>">
        <?php endif ?>

            <div class="checkbox">
            <label>
                <?= $this->section('content') ?>
                <?= $this->escape($element->label) ?>

                <?php /* TOOLTIP */ ?>
                <?php $this->insert('tooltip', compact('element')); ?>
            </label>

            <?php if ($element->feedback) : ?>
                <div class="help-block help-block-feedback">
                    <?= $this->escape($element->feedback) ?>
                </div>
                <?= $this->insert('feedback-icons', ['element' => $element]) ?>
            <?php endif ?>

            <?php if ($element->help) : ?>
                <div class="help-block help-block-plain">
                    <?= $this->escape($element->help) ?>
                </div>
            <?php endif ?>

            <?php if ($element->builder() && $element->builder()->isHorizontal()) : ?>
                </div>
            <?php endif ?>
        </div>

        <?php if ($element->feedback): ?>
            </div>
        <?php endif ?>

    <?php if ($element->append) : ?>
        <?= $this->escape($element->append) ?>
    <?php endif ?>
</div>
