<?php

namespace Projx\Genesis;

class ConfigurationDirector implements Director
{
    /**
     * @var Assembler
     */
    private $assembler;

    /**
     * @param Assembler $assembler
     */
    public function __construct(Assembler $assembler)
    {
        $this->assembler = $assembler;
    }

    /**
     * @param mixed $script
     * @return $this
     */
    public function direct($script)
    {
        $this->assembler->arguments($script->args);

        foreach($script->calls as $mutation) {
            $method = array_shift($mutation);
            $arguments = array_shift($mutation);
            $this->assembler->mutation($method, $arguments);
        }

        return $this;
    }

    /**
     * Creates and returns an object.
     *
     * @return mixed
     */
    public function build()
    {
        return $this->assembler->build();
    }
}
