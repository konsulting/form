<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class CheckboxTest extends TestCase
{
    public function test_it_returns_a_checkbox()
    {
        $button = new Checkbox($this->partialsEngine, 'test');

        $this->assertRegExp('|<label>\s*<input id="[^\"]*" type="checkbox" name="test" value="1"\s*>\s*Test\s*</label>|', (string) $button);
    }

    public function test_it_adds_a_hidden_field_when_forcing_a_value()
    {
        $button = new Checkbox($this->partialsEngine, 'test');
        $button->name = 'test';
        $button->forceValue(1);

        $this->assertRegExp('|<input type="hidden" name="test" value="1"|', (string) $button);
    }
}
