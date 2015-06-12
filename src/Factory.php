<?php

namespace Projx\Genesis;

interface Factory
{
    /**
     * Creates and returns an object, using the provided values as constructor arguments.
     *
     * @param array $arguments
     * @return mixed
     */
    public function make(array $arguments = []);
}
