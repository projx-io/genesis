<?php

namespace Projx\Genesis;

interface Mutator
{
    /**
     * @param mixed $object
     * @param array $arguments
     * @return $this
     */
    public function set($object, array $arguments = []);
}
