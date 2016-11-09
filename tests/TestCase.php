<?php

namespace Konsulting\FormBuilder;

use League\Plates\Engine;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $partialsEngine;
    protected $resolver;

    public function setUp()
    {
        parent::setUp();

        $this->partialsEngine = new Engine(__DIR__ . '/../partials/plain');
        $this->resolver = new ClassResolver(__NAMESPACE__ . '\\Elements\\');
    }
}
