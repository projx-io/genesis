<?php

namespace Projx\Genesis;

class MethodMutator implements Mutator
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var ObjectMutator
     */
    private $mutator;

    /**
     * @param string $method
     * @param ObjectMutator $mutator
     */
    public function __construct($method, ObjectMutator $mutator)
    {
        $this->method = $method;
        $this->mutator = $mutator;
    }

    /**
     * @param mixed $object
     * @param array $arguments
     * @return $this
     */
    public function set($object, array $arguments = [])
    {
        $this->mutator->set($object, $this->method, $arguments);
        return $this;
    }
}
