<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;

class Textarea extends Element
{
    protected $partialName = 'textarea';

    public function __construct(Engine $partial, $name = null, $value = null)
    {
        parent::__construct($partial);

        $this->name = $name;
        $this->value = $value;
    }
}
