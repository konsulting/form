<?php

namespace Konsulting\FormBuilder;

use League\Plates\Engine;

class FormBuilder
{
    protected $partial;
    protected $elementResolver;

    public function __construct(Engine $partial, ClassResolver $elementResolver)
    {
        $this->partial = $partial;
        $this->elementResolver = $elementResolver;
    }

    public function __call($name, $arguments)
    {
        return $this->make($name);
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

    public function make()
    {
        $arguments = func_get_args();
        $name = ucfirst(array_shift($arguments));

        $class = $this->elementResolver->resolve($name);

        return new $class($this->partial, ...$arguments);
    }
}
