<?php

namespace Konsulting\FormBuilder;

use Konsulting\Laravel\Transformer\RulePacks\RulePack;

class DatetimeRulePack extends RulePack
{
    public function ruleToPersistFormat($value, $type = 'datetime')
    {
        return $this->transformer->ruleDateFormat($value, DateTimeFormats::persistenceFormat($type));
    }

    public function ruleToDisplayFormat($value, $type = 'datetime')
    {
        return $this->transformer->ruleDateFormat($value, DateTimeFormats::displayFormat($type));
    }

    public function ruleFromDisplayFormat($value, $type = 'datetime')
    {
        return $this->transformer->ruleCarbon($value, DateTimeFormats::displayFormat($type));
    }

    public function ruleCombineSplitDate($value, $type = 'datetime')
    {
        return DateTimeFormats::combine($value, DateTimeFormats::persistenceFormat($type));
    }
}
