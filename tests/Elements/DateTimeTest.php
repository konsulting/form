<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class DateTimeTest extends TestCase
{
    public function test_it_returns_a_date_time_field()
    {
        $select = new DateTime($this->partialsEngine, 'test', '2016-11-09 11:00');

        $this->assertRegExp('|<input type="datetime" name="test" value="2016-11-09 11:00">|', (string) $select);
    }
}
