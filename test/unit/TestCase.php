<?php

namespace Projx\Genesis;

use Mockery;
use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    public function mock($class, array $methods = [])
    {
        $mock = Mockery::mock($class);
        $spies = (object)[];
        array_map(function ($method) use ($mock, $spies) {
            return $spies->{$method} = $mock->shouldReceive($method);
        }, $methods);
        $spies->mock = $mock;
        return $spies;
    }
}
