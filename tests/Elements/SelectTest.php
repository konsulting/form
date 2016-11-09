<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class SelectTest extends TestCase
{
    public function test_it_returns_a_selectbox()
    {
        $select = new Select($this->partialsEngine, 'test', [0 => 'No', 1 => 'Yes'], 1);

        $this->assertRegExp('|<select name="test">|', (string) $select);
    }

    public function test_it_will_convert_a_simple_array_of_options()
    {
        $options = ['No', 'Yes'];
        $select = new Select($this->partialsEngine, 'test', $options);

        $expected = [
            ['name' => 'No', 'value' => 'No'],
            ['name' => 'Yes', 'value' => 'Yes'],
        ];

        $this->assertEquals($expected, $select->options()->toArray());
    }
}
