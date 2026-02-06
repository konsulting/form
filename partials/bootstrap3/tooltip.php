<?php if ($element->tooltip) : ?>
    <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="bottom"
       title="<?= $this->escape($element->tooltip) ?>" style="padding-left: 2px; cursor: pointer;"></i>
<?php endif; ?>
