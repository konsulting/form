<?php

namespace Konsulting\FormBuilder;

use Konsulting\FormBuilder\Elements\Input;

class FormBuilderTest extends TestCase
{
    public function test_it_can_provide_an_input()
    {
        $builder = new FormBuilder($this->partialsEngine, $this->resolver);

        $this->assertInstanceOf(Input::class, $builder->input());
    }

    public function test_it_can_provide_various_types_of_input()
    {
        $builder = new FormBuilder($this->partialsEngine, $this->resolver);

        $this->assertInstanceOf(Input::class, $builder->text());
        $this->assertMatchesRegularExpression('/type="text"/', (string) $builder->text());

        $this->assertInstanceOf(Input::class, $builder->email());
        $this->assertMatchesRegularExpression('/type="email"/', (string) $builder->email());
    }
}
