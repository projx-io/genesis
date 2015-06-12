<?php

namespace Projx\Genesis;

use ReflectionClass;

class ReflectionFactory implements Factory
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var ReflectionClass
     */
    private $reflection;

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Creates and returns an object, using the provided values as constructor arguments.
     *
     * @param array $arguments
     * @return mixed
     */
    public function make(array $arguments = [])
    {
        if ($this->reflection === null) {
            $this->reflection = new ReflectionClass($this->class);
        }

        return $this->reflection->newInstanceArgs($arguments);
    }
}
