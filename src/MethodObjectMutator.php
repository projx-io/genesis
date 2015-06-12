<?php

namespace Projx\Genesis;

class MethodObjectMutator implements ObjectMutator
{
    /**
     * @param $object
     * @param $method
     * @param array $arguments
     * @return $this
     */
    public function set($object, $method, array $arguments = [])
    {
        call_user_func_array([$object, $method], $arguments);
        return $this;
    }
}
