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

    protected static $parts = [
        'Y' => ['name' => 'year', 'placeholder' => 'YYYY'],
        'y' => ['name' => 'year', 'placeholder' => 'YY'],
        'm' => ['name' => 'month', 'placeholder' => 'MM'],
        'd' => ['name' => 'day', 'placeholder' => 'DD'],
        'H' => ['name' => 'hour', 'placeholder' => 'hh'],
        'i' => ['name' => 'minute', 'placeholder' => 'mm'],
        's' => ['name' => 'seconds', 'placeholder' => 'ss'],
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

    public static function split($date, $format)
    {
        $splitAs = str_split(preg_replace('/[^A-Za-z]/', $format));
        $splitFormat = implode('**', $splitAs);

        $split = explode('**', \DateTime::createFromFormat($format, $date)->format($splitFormat));

        $indexedSplit = array_combine($splitAs, $split);

        return array_filter(array_keys($indexedSplit), function ($result, $key) use ($indexedSplit) {
            $result[static::$parts[$key]['name']] = $indexedSplit[$key];
            return $result;
        }, []);
    }

    public function combine($dateArray, $format)
    {
        $splitFormat = str_split($format);

        return array_filter($splitFormat, function ($result, $key) use ($dateArray) {
            $result .= isset(static::$parts[$key]) ? $dateArray[static::$parts[$key]] : $key;
            return $result;
        }, '');
    }
}
