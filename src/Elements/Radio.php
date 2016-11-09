<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;

class Radio extends Checkbox
{
    protected $partialName = 'checkbox-radio';
    protected $forceValue;

    public function __construct(Engine $partial, $name, $value = null)
    {
        parent::__construct($partial, $name, $value);

        $this->type = 'radio';
    }
}
