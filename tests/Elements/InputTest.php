<?php

namespace Konsulting\FormBuilder\Elements;

use Konsulting\FormBuilder\TestCase;

class InputTest extends TestCase
{
    public function test_it_returns_an_input_tag_of_a_given_type()
    {
        $input = new Input($this->partialsEngine, 'text', 'test');
        $input2 = new Input($this->partialsEngine, 'email', 'test');

        $this->assertRegexp('|input type="text"|', (string) $input);
        $this->assertRegexp('|input type="email"|', (string) $input2);
    }

    public function test_it_will_add_a_label()
    {
        $input = new Input($this->partialsEngine, 'text', 'test');
        $input->withLabel('Label');

        $this->assertRegexp('/Label/', (string) $input);
    }

    public function test_it_will_add_a_help_block()
    {
        $input = new Input($this->partialsEngine, 'text', 'test');
        $input->withHelp('Help');

        $this->assertRegexp('/Help/', (string) $input);
    }

    public function test_it_will_add_an_error()
    {
        $input = new Input($this->partialsEngine, 'text', 'test');
        $input->withError('Error');

        $this->assertRegexp('/Error/', (string) $input);
    }

    public function test_it_will_add_feedback()
    {
        $input = new Input($this->partialsEngine, 'text', 'test');
        $input->withFeedback('success', 'Success');

        $this->assertRegexp('/Success/', (string) $input);
    }

    public function test_it_will_add_a_block_before()
    {
        $input = new Input($this->partialsEngine, 'text', 'test');
        $input->prepend('Prepend');

        $this->assertRegexp('/Prepend/', (string) $input);
    }

    public function test_it_will_add_a_block_after()
    {
        $input = new Input($this->partialsEngine, 'text', 'test');
        $input->append('Append');

        $this->assertRegexp('/Append/', (string) $input);
    }

    public function test_a_hidden_field_is_kept_simple()
    {
        $input = new Input($this->partialsEngine, 'hidden', 'test');
        $input->withLabel('Label');

        $this->assertNotRegexp('/Label/', (string) $input);
    }
}
