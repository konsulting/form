<?php

namespace Konsulting\FormBuilder\Laravel;

use Illuminate\Support\Facades\Facade;
use Konsulting\FormBuilder\FormBuilder;

class FormBuilderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FormBuilder::class;
    }
}
