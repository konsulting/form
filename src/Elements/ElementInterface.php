<?php

namespace Konsulting\FormBuilder\Elements;

interface ElementInterface
{
    public function withValue($value);

    public function withLabel($label);

    public function withoutLabel();

    public function withHelp($label);

    public function withError($error);

    public function withoutError();

    public function withFeedback($type, $message);

    public function withoutFeedback();

    public function withAttributes($attributes = []);

    public function withAddon($content, $position = 'after');

    public function prepend($prepend);

    public function append($append);

    public function __toString();

    public function attributes();

    public function attributesExcept();

    public function getLabelFor();

    public function withTooltip($text);
}
