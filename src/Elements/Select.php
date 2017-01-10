<?php

namespace Konsulting\FormBuilder\Elements;

use Illuminate\Support\Collection;
use League\Plates\Engine;

class Select extends Element
{
    protected $partialName = 'select';
    protected $options = [];
    protected $selected;
    protected $primaryOption;
    protected $writableProperties = ['label', 'feedback', 'feedbackType', 'prepend', 'append', 'showLabel', 'addons', 'tooltip'];

    public function __construct(Engine $partial, $name = null, $options = [], $selected = null)
    {
        parent::__construct($partial);

        $this->name = $name;
        $this->withOptions($options);
        $this->withSelected($selected);
    }

    public function withOptions($options)
    {
        $this->options = Collection::make($options);

        return $this;
    }

    public function withSelected($selected)
    {
        $this->selected = Collection::make((array) $selected);

        return $this;
    }

    public function withValue($value)
    {
        return $this->withSelected($value);
    }

    public function withPrimaryOption($name, $value)
    {
        $this->primaryOption = ['name' => $name, 'value' => $value];

        return $this;
    }

    public function options()
    {
        $options = is_array($this->options->first())
            ? $this->options
            : $this->convertOneDimensionOptions();

        if (! empty($this->primaryOption)) {
            array_unshift($options, $this->primaryOption);
        }

        return $options;
    }

    protected function convertOneDimensionOptions()
    {
        return $this->options->map(function($item) {
            return ['name' => $item, 'value' => $item];
        });
    }

    public function isGrouped()
    {
        $first = $this->options->first();

        return is_array($first) && is_array($first['value']);
    }

    public function isSelected($value)
    {
        return $this->selected->contains($value);
    }
}
