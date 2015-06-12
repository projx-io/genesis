<?php

namespace Projx\Genesis;

interface ObjectMutator
{
    /**
     * @param $object
     * @param $method
     * @param array $arguments
     * @return $this
     */
    public function set($object, $method, array $arguments = []);
}
