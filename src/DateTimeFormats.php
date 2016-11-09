<?php

namespace Konsulting\FormBuilder;

class DateTimeFormats
{
    protected static $formatsIn = [
        'date' => 'Y-m-d',
        'time' => 'H:i',
        'datetime' => 'Y-m-d H:i',
        'append_seconds' => ':s',
    ];

    protected static $formatsOut = [
        'date' => 'Y-m-d',
        'time' => 'H:i',
        'datetime' => 'Y-m-d H:i',
        'append_seconds' => ':s',
    ];

    protected static function setInFormat($name, $format)
    {
        static::$formatsIn[$name] = $format;
    }

    protected static function setOutFormat($name, $format)
    {
        static::$formatsOut[$name] = $format;
    }

    protected static function checkName($name)
    {
        if (! in_array($name, array_keys(static::$formatsIn))) {
            throw new \InvalidArgumentException("Unknown format '{$name}'");
        }
    }

    public static function inFormat($signature)
    {
        return array_reduce(explode('|', $signature), function($format, $name) {
            static::checkName($name);
            $format .= static::$formatsIn[$name];

            return $format;
        }, '');
    }

    public static function outFormat($signature)
    {
        return array_reduce(explode('|', $signature), function($format, $name) {
            static::checkName($name);
            $format .= static::$formatsOut[$name];

            return $format;
        }, '');
    }
}
