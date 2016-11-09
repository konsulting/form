<?php

namespace Konsulting\FormBuilder\Elements;

use Illuminate\Support\Collection;

class ElementAttributes extends Collection
{
    public function escapedString()
    {
        return $this->map(function ($value, $name) {
            return ['name' => $name, 'value' => htmlspecialchars($value)];
        })->reduce(function ($output, $attribute) {
            return $output .= " {$attribute['name']}=\"{$attribute['value']}\"";
        }, '');
    }
}
