<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class ButtonTest extends TestCase
{
    public function test_it_returns_a_button()
    {
        $button = new Button($this->partialsEngine, 'submit', 'Text');

        $this->assertRegExp('|<button type="submit"\s*>\s*Text\s*</button>|', (string) $button);
    }
}
