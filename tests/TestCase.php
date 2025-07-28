<?php

namespace Konsulting\FormBuilder;

use League\Plates\Engine;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $partialsEngine;
    protected $resolver;

    protected function setUp(): void
    {
        parent::setUp();

        $this->partialsEngine = new Engine(__DIR__ . '/../partials/plain');
        $this->resolver = new ClassResolver(__NAMESPACE__ . '\\Elements\\');
    }
}
