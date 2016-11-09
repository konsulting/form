<?php

namespace Konsulting\FormBuilder;

class ClassResolver
{
    protected $namespaces = [];
    protected $resolvedNames = [];

    public function __construct($namespaces)
    {
        $this->namespaces = (array) $namespaces;
    }

    public function resolve($name)
    {
        if (! isset($this->resolvedNames[$name])) {
            $this->resolvedNames[$name] = $this->locateClass($name);
        }

        return $this->resolvedNames[$name];
    }

    protected function locateClass($name)
    {
        foreach ($this->namespaces as $namespace) {
            $full = $namespace . $name;

            if (class_exists($full)) {
                return $full;
            }
        }

        throw new UnknownClass($name . ' class could not be found.');
    }

    public function addNamespace($namespace)
    {
        $this->namespaces = array_unique(array_merge($this->namespaces, (array) $namespace));
    }
}
