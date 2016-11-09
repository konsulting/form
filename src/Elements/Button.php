<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;

class Button extends Element
{
    protected $partialName = 'button';
    protected $text;
    protected $writableProperties = ['feedback', 'feedbackType', 'prepend', 'append', 'text', 'addons'];

    public function __construct(Engine $partial, $type = 'submit', $text = null)
    {
        parent::__construct($partial);

        $this->type = $type;
        $this->text = $text;
    }
}
