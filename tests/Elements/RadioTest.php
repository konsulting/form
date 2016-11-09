<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class RadioTest extends TestCase
{
    public function test_it_returns_a_checkbox()
    {
        $button = new Radio($this->partialsEngine, 'test');

        $this->assertRegExp('|<label>\s*<input type="radio" name="test" value=""\s*>\s*Test\s*</label>|', (string) $button);
    }
}
