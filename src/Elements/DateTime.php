<?php

namespace Konsulting\FormBuilder\Elements;

class DateTime extends Date
{
    protected $partialName = 'date-time';
    protected $timeFormat = 'datetime';
    protected $withSeconds = false;

    public function withSeconds()
    {
        $this->withSeconds = true;
    }

    public function withoutSeconds()
    {
        $this->withSeconds = false;
    }

    public function timeFormat()
    {
        return $this->timeFormat . ($this->withSeconds ? '|seconds' : '');
    }
}
