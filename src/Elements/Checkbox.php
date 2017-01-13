<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;

class Checkbox extends Element implements Checkable
{
    protected $partialName = 'checkbox-radio';
    protected $forceValue;
    protected $checked;
    protected $writableProperties = ['label', 'feedback', 'feedbackType', 'prepend', 'append', 'showLabel', 'forceValue', 'checked', 'addons', 'tooltip'];

    public function __construct(Engine $partial, $name = null, $value = 1)
    {
        parent::__construct($partial);

        $this->type = 'checkbox';
        $this->name = $name;
        $this->value = $value;
    }

    public function forceValue($value)
    {
        $this->forceValue = $value;

        return $this;
    }

    public function dontForceValue()
    {
        $this->forceValue = null;

        return $this;
    }

    public function checked($bool = true)
    {
        $this->checked = $bool;

        return $this;
    }
}
