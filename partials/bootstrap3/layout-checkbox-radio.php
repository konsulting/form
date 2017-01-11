<div class="field-wrapper">
    <?php if ($element->prepend) : ?>
        <?= $element->prepend ?>
    <?php endif ?>

    <?php if ($element->feedback): ?>
    <div class="has-<?= $element->feedbackType ?><?= $element->showFeedbackIcons ? ' has-feedback' : '' ?>">
        <?php endif ?>

        <div class="checkbox">
            <label>
                <?= $this->section('content') ?>
                <?= $this->escape($element->label) ?>

                <?php /* TOOLTIP */ ?>
                <?php $this->insert('tooltip', compact('element')); ?>
            </label>

            <?php if ($element->feedback) : ?>
                <div class="help-block">
                    <?= $this->escape($element->feedback) ?>
                </div>
                <?= $this->insert('feedback-icons', ['element' => $element]) ?>
            <?php endif ?>

            <?php if ($element->help) : ?>
                <div class="help-block help-block-plain">
                    <?= $this->escape($element->help) ?>
                </div>
            <?php endif ?>
        </div>

        <?php if ($element->feedback): ?>
    </div>
<?php endif ?>

    <?php if ($element->append) : ?>
        <?= $element->append ?>
    <?php endif ?>
</div>
