<?php

namespace Projx\Genesis;

class ClassFactoryContainer implements ClassFactory
{
    /**
     * @var Factory[]
     */
    private $factories;

    /**
     * @param Factory[] $factories
     */
    public function __construct(array $factories = [])
    {
        $this->factories = $factories;
    }

    /**
     * Creates and returns an object, using the provided values as constructor arguments.
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function make($name, array $arguments = [])
    {
        return $this->factories[$name]->make($arguments);
    }
}