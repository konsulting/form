<?php

namespace Konsulting\FormBuilder\Elements;

use Illuminate\Support\Collection;
use League\Plates\Engine;

class Element
{
    protected $label;
    protected $showLabel = true;
    protected $feedback;
    protected $feedbackType;
    protected $help;
    protected $prepend;
    protected $append;
    protected $addons;
    protected $tooltip;

    protected $attributes = [];
    protected $partial;
    protected $partialName = 'element';
    protected $writableProperties = ['label', 'feedback', 'feedbackType', 'prepend', 'append', 'showLabel', 'addons', 'tooltip'];

    public function __construct(Engine $partial)
    {
        $this->partial = $partial;
        $this->attributes = new ElementAttributes;
        $this->id = md5(uniqid(rand(), true));
        $this->addons = Collection::make([]);
    }

    public function withValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function withLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function withoutLabel()
    {
        $this->label = null;

        return $this;
    }

    public function withHelp($label)
    {
        $this->label = $label;

        return $this;
    }

    public function withError($error)
    {
        $this->withFeedback('error', $error);

        return $this;
    }

    public function withoutError()
    {
        return $this->withoutFeedback();
    }

    public function withFeedback($type, $message)
    {
        $type = strtolower($type);

        if (! in_array($type, ['success', 'warning', 'error'])) {
            throw new \InvalidArgumentException("Unknown Feedback type {$type}");
        }

        if (empty($message)) {
            return $this->withoutFeedback();
        }

        $this->feedbackType = $type;
        $this->feedback = $message;

        return $this;
    }

    public function withoutFeedback()
    {
        $this->feedbackType = null;
        $this->feedback = null;

        return $this;
    }

    public function withAttributes($attributes = [])
    {
        foreach ($attributes as $attribute => $value) {
            $this->{$attribute} = $value;
        }

        return $this;
    }

    public function withAddon($content, $position = 'after')
    {
        $this->addons[] = compact('content', 'position');

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

        if (func_num_args() == 1) {
            return $this->attributes->only(func_get_args()[0]);
        }

        return $this->attributes->only((array) func_get_args());
    }

    public function attributesExcept()
    {
        if (func_num_args() == 0) {
            return $this->attributes;
        }

        if (func_num_args() == 1) {
            return $this->attributes->except(func_get_args()[0]);
        }

        return $this->attributes->except((array) func_get_args());
    }

    public function getLabelFor()
    {
        return $this->id;
    }

    public function withTooltip($text)
    {
        $this->tooltip = $text;

        return $this;
    }
}
