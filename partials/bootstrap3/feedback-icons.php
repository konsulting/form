<?php if ($element->showFeedbackIcons) : ?>
    <?php if ($element->feedbackType == 'success'): ?>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span class="sr-only">(success)</span>
    <?php elseif ($element->feedbackType == 'warning'): ?>
        <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
        <span class="sr-only">(warning)</span>
    <?php elseif ($element->feedbackType == 'error'): ?>
        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
        <span class="sr-only">(error)</span>
    <?php endif ?>
<?php endif ?>
