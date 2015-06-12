<?php

namespace Projx\Genesis;

class ClassAssembler implements Assembler
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var ObjectMutator
     */
    private $mutator;

    /**
     * @var array
     */
    private $arguments = [];

    /**
     * @var array
     */
    private $mutations = [];

    /**
     * @param Factory $factory
     * @param ObjectMutator $mutator
     */
    public function __construct(Factory $factory, ObjectMutator $mutator)
    {
        $this->factory = $factory;
        $this->mutator = $mutator;
    }

    /**
     * @param array $arguments
     * @return $this
     */
    public function arguments(array $arguments = [])
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return $this
     */
    public function mutation($method, array $arguments = [])
    {
        $this->mutations[$method] = $arguments;
        return $this;
    }

    /**
     * Creates and returns an object.
     *
     * @return mixed
     */
    public function build()
    {
        $value = $this->factory->make($this->arguments);

        array_map(function ($arguments, $method) use ($value) {
            $this->mutator->set($value, $method, $arguments);
        }, $this->mutations, array_keys($this->mutations));

        return $value;
    }
}