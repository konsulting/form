<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class DateTimeTest extends TestCase
{
    public function test_it_returns_a_date_time_field()
    {
        $input = new DateTime($this->partialsEngine, 'test', '2016-11-09 11:00');

        $this->assertRegExp('|<input type="datetime" id="[^\"]*" name="test" value="2016-11-09 11:00">|', (string) $input);
    }

    public function test_it_returns_a_split_date_time_field()
    {
        $input = new DateTime($this->partialsEngine, 'test', '2016-11-09 11:00');
        $input->split();

        $this->assertRegExp('|<input type="text" id="[^\"]*" name="test\[year\]" value="2016" placeholder="YYYY" maxlength="4">|', (string) $input);
        $this->assertRegExp('|<input type="text" id="[^\"]*" name="test\[month\]" value="11" placeholder="MM" maxlength="2">|', (string) $input);
        $this->assertRegExp('|<input type="text" id="[^\"]*" name="test\[day\]" value="09" placeholder="DD" maxlength="2">|', (string) $input);
        $this->assertRegExp('|<input type="text" id="[^\"]*" name="test\[hour\]" value="11" placeholder="hh" maxlength="2">|', (string) $input);
        $this->assertRegExp('|<input type="text" id="[^\"]*" name="test\[minute\]" value="00" placeholder="mm" maxlength="2">|', (string) $input);
    }
}
