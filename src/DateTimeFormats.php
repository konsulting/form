<?php

namespace Konsulting\FormBuilder;

class DateTimeFormats
{
    protected static $formatsToPersist = [
        'date' => 'Y-m-d',
        'time' => 'H:i',
        'datetime' => 'Y-m-d H:i',
        'append_seconds' => ':s',
    ];

    protected static $formatsToDisplay = [
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

    protected static $cachedPlaceholders = [];

    public static function setPersistenceFormat($name, $format)
    {
        static::$formatsToPersist[$name] = $format;
    }

    public static function setDisplayFormat($name, $format)
    {
        static::$formatsToDisplay[$name] = $format;
    }

    public static function checkName($name)
    {
        if (! in_array($name, array_keys(static::$formatsToPersist))) {
            throw new \InvalidArgumentException("Unknown format '{$name}'");
        }
    }

    public static function persistenceFormat($signature)
    {
        return array_reduce(explode('|', $signature), function($format, $name) {
            static::checkName($name);
            $format .= static::$formatsToPersist[$name];

            return $format;
        }, '');
    }

    public static function displayFormat($signature)
    {
        return array_reduce(explode('|', $signature), function($format, $name) {
            static::checkName($name);
            $format .= static::$formatsToDisplay[$name];

            return $format;
        }, '');
    }

    public static function split($date, $format)
    {
        $splitAs = str_split(preg_replace('/[^A-Za-z]/','',$format));
        $splitFormat = implode('**', $splitAs);

        if (empty($date)) {
            $indexedSplit = array_fill_keys($splitAs, '');
        } else {
            $split = explode('**', \DateTime::createFromFormat($format, $date)->format($splitFormat));
            $indexedSplit = array_combine($splitAs, $split);
        }

        return array_reduce(array_keys($indexedSplit), function ($result, $key) use ($indexedSplit) {
            $result[static::$parts[$key]['name']] = $indexedSplit[$key];
            return $result;
        }, []);
    }

    public static function combine($dateArray, $format)
    {
        $splitFormat = str_split($format);

        $combined = array_reduce($splitFormat, function ($result, $key) use ($dateArray) {
            $result .= isset(static::$parts[$key]) ? $dateArray[static::$parts[$key]['name']] : $key;
            return $result;
        }, '');

        return ! \DateTime::createFromFormat($format, $combined) ? '' : $combined;
    }

    public static function placeholders($format)
    {
        if (! isset(static::$cachedPlaceholders[$format])) {
            $split = str_split(preg_replace('/[^A-Za-z]/','',$format));

            static::$cachedPlaceholders[$format] = array_reduce($split, function ($result, $key) {
                $result[static::$parts[$key]['name']] = static::$parts[$key]['placeholder'];
                return $result;
            }, []);
        }

        return static::$cachedPlaceholders[$format];
    }
}
