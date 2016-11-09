<?php

namespace Konsulting\FormBuilder\Elements;

use League\Plates\Engine;

class Element
{
    protected $label;
    protected $showLabel = true;
    protected $error;
    protected $help;
    protected $prepend;
    protected $append;

    protected $attributes = [];
    protected $partial;
    protected $partialName = 'element';
    protected $writableProperties = ['label', 'error', 'prepend', 'append', 'showLabel'];

    public function __construct(Engine $partial)
    {
        $this->partial = $partial;
        $this->attributes = new ElementAttributes;
    }

    public function withLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function withHelp($label)
    {
        $this->label = $label;

        return $this;
    }

    public function withError($error)
    {
        $this->error = $error;

        return $this;
    }

    public function prepend($prepend)
    {
        $this->prepend = $prepend;

        return $this;
    }

    public function append($append)
    {
        $this->append = $append;

        return $this;
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name) && in_array($name, $this->writableProperties)) {
            $this->{$name} = $value;
            return;
        }

        $this->attributes[$name] = $value;

        if ($name == 'name' && empty($this->label)) {
            $this->label = ucwords(str_replace('_', ' ', $value));
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name) && in_array($name, $this->writableProperties)) {
            return $this->{$name};
        }

        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    public function __toString()
    {
        return trim($this->partial->render($this->partialName, [
            'element' => $this
        ]));
    }

    public function attributes()
    {
        if (func_num_args() == 0) {
            return $this->attributes;
        }

        return $this->attributes->only((array) func_get_args());
    }

    public function attributesExcept()
    {
        if (func_num_args() == 0) {
            return $this->attributes;
        }

        return $this->attributes->except((array) func_get_args());
    }
}
