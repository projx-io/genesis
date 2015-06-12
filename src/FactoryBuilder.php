<?php

namespace Projx\Genesis;

class FactoryBuilder implements Builder
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $arguments;

    /**
     * @param ClassFactory $factory
     * @param string $name
     * @param array $arguments
     */
    public function __construct(ClassFactory $factory, $name = null, $arguments = [])
    {
        $this->factory = $factory;
        $this->name = $name;
        $this->arguments = $arguments;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function argument($value)
    {
        $this->arguments[] = $value;
        return $this;
    }

    /**
     * Creates and returns an object.
     *
     * @return mixed
     */
    public function build()
    {
        return $this->factory->make($this->name, $this->arguments);
    }
}
