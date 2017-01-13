<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;
use Konsulting\FormBuilder\DateTimeFormats;

class Date extends Element
{
    protected $partialName = 'date-time';
    protected $timeFormat = 'date';
    protected $split = false;
    protected $writableProperties = ['label', 'feedback', 'feedbackType', 'prepend', 'append', 'showLabel', 'split', 'addons', 'tooltip'];

    public function __construct(Engine $partial, $name = null, $value = null)
    {
        parent::__construct($partial);

        $this->name = $name;
        $this->withValue($value);
    }

    public function __set($name, $value)
    {
        parent::__set($name, $value);
    }

    public function withValue($value)
    {
        $this->value = $this->prepareValue($value);

        return $this;
    }

    public function prepareValue($value)
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof \DateTimeInterface) {
            return $value->format(DateTimeFormats::displayFormat($this->timeFormat()));
        }

        $dateTime = \DateTime::createFromFormat(DateTimeFormats::persistenceFormat($this->timeFormat()), $value);

        if (! $dateTime) {
            $dateTime = \DateTime::createFromFormat(DateTimeFormats::displayFormat($this->timeFormat()), $value);
        }

        return $dateTime
            ? $dateTime->format(DateTimeFormats::displayFormat($this->timeFormat()))
            : null;
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
