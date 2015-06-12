<?php

namespace Projx\Genesis;

interface Director extends Builder
{
    /**
     * @param mixed $script
     * @return $this
     */
    public function direct($script);
}
