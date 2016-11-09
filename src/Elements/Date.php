<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;
use Konsulting\FormBuilder\DateTimeFormats;

class Date extends Element
{
    protected $partialName = 'date';
    protected $timeFormat = 'date';

    public function __construct(Engine $partial, $name = null, $value = null)
    {
        parent::__construct($partial);

        $this->name = $name;
        $this->value = $value;
    }

    public function __set($name, $value)
    {
        if ($name == 'value') {
            $value = $this->prepareValue($value);
        }

        parent::__set($name, $value);
    }

    public function prepareValue($value)
    {
        return \DateTime::createFromFormat(DateTimeFormats::inFormat($this->timeFormat()), $value)
            ->format(DateTimeFormats::outFormat($this->timeFormat()));
    }

    protected function timeFormat()
    {
        return $this->timeFormat;
    }
}
