<?php

namespace Konsulting\FormBuilder;

use Konsulting\FormBuilder\Elements\Input;
use Konsulting\FormBuilder\Elements\Textarea;
use Konsulting\FormBuilder\Elements\Select;

class XssTest extends TestCase
{
    public function test_input_static_value_is_escaped()
    {
        $input = new Input($this->partialsEngine, 'static', 'test');
        $input->value('"><script>alert("XSS")</script>');

        $html = (string) $input;
        $this->assertStringNotContainsString('"><script>alert("XSS")</script>', $html);
        $this->assertStringContainsString('&quot;&gt;&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', $html);
    }

    public function test_textarea_value_is_escaped()
    {
        $textarea = new Textarea($this->partialsEngine, 'test');
        $textarea->value('</textarea><script>alert("XSS")</script>');

        $html = (string) $textarea;
        $this->assertStringNotContainsString('</textarea><script>alert("XSS")</script>', $html);
        $this->assertStringContainsString('&lt;/textarea&gt;&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', $html);
    }

    public function test_select_options_are_escaped()
    {
        $select = new Select($this->partialsEngine, 'test');
        $select->options([
            '"><script>alert("XSS-value")</script>' => '"><script>alert("XSS-name")</script>'
        ]);

        $html = (string) $select;
        $this->assertStringNotContainsString('"><script>alert("XSS-value")</script>', $html);
        $this->assertStringNotContainsString('"><script>alert("XSS-name")</script>', $html);
    }

    public function test_optgroup_label_is_escaped()
    {
        $select = new Select($this->partialsEngine, 'test');
        $select->options([
            'Group "><script>alert("XSS")</script>' => ['value' => 'name']
        ]);

        $html = (string) $select;
        $this->assertStringNotContainsString('Group "><script>alert("XSS")</script>', $html);
    }

    public function test_prepend_and_append_are_escaped()
    {
        $input = new Input($this->partialsEngine, 'text', 'test');
        $input->prepend('"><script>alert("XSS-prepend")</script>');
        $input->append('"><script>alert("XSS-append")</script>');

        $html = (string) $input;
        $this->assertStringNotContainsString('"><script>alert("XSS-prepend")</script>', $html);
        $this->assertStringNotContainsString('"><script>alert("XSS-append")</script>', $html);
    }

    public function test_addons_are_escaped()
    {
        $input = new Input($this->partialsEngine, 'text', 'test');
        $input->addAddon('"><script>alert("XSS-addon")</script>', 'before');

        $html = (string) $input;
        $this->assertStringNotContainsString('"><script>alert("XSS-addon")</script>', $html);
    }
}
