<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;

class Input extends Element
{
    protected $partialName = 'input';

    public function __construct(Engine $partial, $type = 'text', $name = null, $value = null)
    {
        parent::__construct($partial);

        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
    }

    public function __set($name, $value)
    {
        if (in_array('name', ['radio', 'checkbox'])) {
            throw new \Exception('Create Checkbox/Radio directly.');
        }

        parent::__set($name, $value);
    }
}
