<?php

namespace Projx\Genesis;

interface Director extends Builder
{
    /**
     * @param mixed $script
     * @return Director
     */
    public function direct($script);
}
