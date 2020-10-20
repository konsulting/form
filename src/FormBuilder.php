<?php

namespace Konsulting\FormBuilder;

use League\Plates\Engine;

class FormBuilder
{
    protected $decorators = [];
    protected $partial;
    protected $elementResolver;
    protected $wirePrefix = '';

    // Perhaps should be in a separate Form object...
    protected $formName;
    protected $isHorizontal;
    protected $horizontalClasses = [
        'input' => 'col-sm-2',
        'control' => 'col-sm-10',
        'checkbox' => 'col-sm-offset-2 col-sm-10'
    ];

    public function __construct(Engine $partial, ClassResolver $elementResolver)
    {
        $this->partial = $partial;
        $this->elementResolver = $elementResolver;
    }

    public function __call($name, $arguments)
    {
        return $this->make($name, ...$arguments);
    }

    public function input($type = 'text', $name = null, $value = null)
    {
        return $this->make('Input', $type, $name, $value);
    }

    public function text($name = null, $value = null)
    {
        return $this->input('text', $name, $value);
    }

    public function email($name = null, $value = null)
    {
        return $this->input('email', $name, $value);
    }

    public function tel($name = null, $value = null)
    {
        return $this->input('tel', $name, $value);
    }

    public function phone($name = null, $value = null)
    {
        return $this->tel($name, $value);
    }

    public function make($name, ...$arguments)
    {
        $class = $this->elementResolver->resolve($name);
        $field = new $class($this->partial, ...$arguments);

        $field->setBuilder($this);

        return $this->decorate($field);
    }

    protected function decorate($field)
    {
        foreach ($this->decorators as $decorator) {
            $field = new $decorator($field);
        }

        return $field;
    }

    public function setDecorators($decorators)
    {
        $this->decorators = (array) $decorators;
    }

    public function addDecorators($decorators)
    {
        $this->decorators = array_merge($this->decorators, (array) $decorators);

        return $this;
    }

    public function getFormName()
    {
        return $this->formName;
    }

    public function setFormName($formName)
    {
        $this->formName = $formName;

        return $this;
    }

    public function horizontal($inputClass = null, $controlClass = null)
    {
        $this->isHorizontal = true;

        $this->horizontalClasses['input'] = $inputClass ?: $this->horizontalClasses['input'];
        $this->horizontalClasses['control'] = $controlClass ?: $this->horizontalClasses['control'];

        return $this;
    }

    public function notHorizontal()
    {
        $this->isHorizontal = false;
    }

    public function isHorizontal()
    {
        return $this->isHorizontal;
    }

    public function horizontalClass($class)
    {
        if (! in_array($class, ['input', 'control', 'checkbox'])) {
            throw new \UnexpectedValueException("Unknown element {$class}.");
        }

        return $this->isHorizontal() ? $this->horizontalClasses[$class] : '';
    }


    public function setWirePrefix($prefix)
    {
        $this->wirePrefix = $prefix;

        return $this;
    }

    public function getWirePrefix()
    {
        return $this->wirePrefix;
    }
}
