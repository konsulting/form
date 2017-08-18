<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class DateTest extends TestCase
{
    public function test_it_returns_a_date_field()
    {
        $input = new Date($this->partialsEngine, 'test', '2016-11-09');

        $this->assertRegExp('|<input type="date" id="[^\"]*" name="test" value="2016-11-09">|', (string) $input);
    }

    public function test_it_returns_a_split_date_time_field()
    {
        $input = new Date($this->partialsEngine, 'test', '2016-11-09');
        $input->split();

        $this->assertRegExp('|<input type="text" id="[^\"]*" name="test\[year\]" value="2016" placeholder="YYYY" maxlength="4">|', (string) $input);
        $this->assertRegExp('|<input type="text" id="[^\"]*" name="test\[month\]" value="11" placeholder="MM" maxlength="2">|', (string) $input);
        $this->assertRegExp('|<input type="text" id="[^\"]*" name="test\[day\]" value="09" placeholder="DD" maxlength="2">|', (string) $input);
    }
}
