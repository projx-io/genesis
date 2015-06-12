<?php

namespace Test\Fake;

class FakeClassA
{
    /**
     * @var array
     */
    public $arguments;

    /**
     *
     */
    public function __construct()
    {
        $this->arguments = func_get_args();
    }
}
