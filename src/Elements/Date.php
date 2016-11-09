<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;
use Konsulting\FormBuilder\DateTimeFormats;

class Date extends Element
{
    protected $partialName = 'date-time';
    protected $timeFormat = 'date';
    protected $split = false;
    protected $writableProperties = ['label', 'feedback', 'feedbackType', 'prepend', 'append', 'showLabel', 'split', 'addons'];

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
        if (empty($value)) {
            return '';
        }

        $dateTime = \DateTime::createFromFormat(DateTimeFormats::persistenceFormat($this->timeFormat()), $value);

        return $dateTime
            ? $dateTime->format(DateTimeFormats::displayFormat($this->timeFormat()))
            : '';
    }

    public function timeFormat()
    {
        return $this->timeFormat;
    }

    public function split($bool = true)
    {
        $this->split = $bool;

        return $this;
    }

    public function getSplitValue()
    {
        return DateTimeFormats::split($this->value, DateTimeFormats::displayFormat($this->timeFormat()));
    }

    public function getSplitPlaceholders()
    {
        return DateTimeFormats::placeholders(DateTimeFormats::displayFormat($this->timeFormat()));
    }

    public function getLabelFor()
    {
        if ($this->split) {
            return $this->id . '-1';
        }
        return $this->id;
    }
}
