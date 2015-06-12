<?php

namespace Projx\Genesis;

interface Assembler extends Builder
{
    /**
     * @param array $arguments
     * @return $this
     */
    public function arguments(array $arguments = []);

    /**
     * @param string $method
     * @param array $arguments
     * @return $this
     */
    public function mutation($method, array $arguments = []);
}
