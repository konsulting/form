<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;

class Checkbox extends Element
{
    protected $partialName = 'checkbox-radio';
    protected $forceValue;
    protected $writableProperties = ['label', 'error', 'prepend', 'append', 'showLabel', 'forceValue'];

    public function __construct(Engine $partial, $name, $value = null)
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
}
