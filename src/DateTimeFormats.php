<?php

namespace Konsulting\FormBuilder;

class DateTimeFormats
{
    protected static $formatsToPersist = [
        // Date persistence format is same as Date format since date is expressed as datetime in mysql
        'date' => 'Y-m-d H:i:s',
        'time' => 'H:i:s',
        'datetime' => 'Y-m-d H:i:s',
        'time-with-seconds' => 'H:i:s',
        'datetime-with-seconds' => 'Y-m-d H:i:s'
    ];

    protected static $formatsToDisplay = [
        'date' => 'Y-m-d',
        'time' => 'H:i',
        'datetime' => 'Y-m-d H:i',
        'time-with-seconds' => 'H:i:s',
        'datetime-with-seconds' => 'Y-m-d H:i:s'
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

    public static function persistenceFormat($name)
    {
        static::checkName($name);
        return static::$formatsToPersist[$name];
    }

    public static function displayFormat($name)
    {
        static::checkName($name);
        return static::$formatsToDisplay[$name];
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
            if (isset(static::$parts[$key])) {
                // there was an issue if a date cast to Carbon by Laravel but in some cases we didn't include
                // all of the data (e.g. trailing H:i:s), so if that is the case, we'll add dummy zeros.
                // I expect there is a better solution to this but we're pushed for time right now.

                $result.= isset($dateArray[static::$parts[$key]['name']]) ? $dateArray[static::$parts[$key]['name']] : '00';
            } else {
                $result .= $key;
            }

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
