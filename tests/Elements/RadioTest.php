<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class RadioTest extends TestCase
{
    public function test_it_returns_a_checkbox()
    {
        $button = new Radio($this->partialsEngine, 'test');

        $this->assertMatchesRegularExpression('|<label>\s*<input id="[^\"]*" type="radio" name="test" value=""\s*>\s*Test\s*</label>|', (string) $button);
    }
}
