<?php

namespace Konsulting\FormBuilder\Laravel;

use Illuminate\Support\Arr;
use Illuminate\Support\ViewErrorBag;
use Konsulting\FormBuilder\ClassResolver;
use Konsulting\FormBuilder\Elements\Checkable;
use Konsulting\FormBuilder\FormBuilder as BaseFormBuilder;
use League\Plates\Engine;

class FormBuilder extends BaseFormBuilder
{
    protected $errors;
    protected $data;

    public function __construct(Engine $partial, ClassResolver $elementResolver)
    {
        parent::__construct($partial, $elementResolver);

        $this->data = [];
        $this->withErrors(session()->get('errors', new ViewErrorBag));
    }

    public function withErrors(ViewErrorBag $errors)
    {
        $this->errors = $errors;

        return $this;
    }

    public function withData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function make($name, ...$arguments)
    {
        $field = parent::make($name, ...$arguments);

        if (is_null($field->name)) {
            return $field;
        }

        $dotName = $this->dotFormat($field->name);

        $overrideValue = old($dotName, Arr::get($this->data, $dotName));

        if ($field->baseElement() instanceof Checkable) {
            $field->checked($overrideValue == $field->value);
        } elseif (isset($overrideValue)) {
            $field->withValue($overrideValue);
        }

        return $field->withError($this->errors->first($dotName));
    }

    protected function dotFormat($name)
    {
        return str_replace(['[]', '[', ']'], ['', '.', ''], $name);
    }
}
