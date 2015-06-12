<?php

namespace Projx\Genesis;

interface ClassFactory
{
    /**
     * Creates and returns an object, using the provided values as constructor arguments.
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function make($name, array $arguments = []);
}
