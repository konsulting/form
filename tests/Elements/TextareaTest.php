<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class TextareaTest extends TestCase
{
    public function test_it_returns_a_textarea()
    {
        $select = new Textarea($this->partialsEngine, 'test', 'Text');

        $this->assertMatchesRegularExpression('|<textarea id="[^\"]*" name="test">Text</textarea>|', (string) $select);
    }
}
