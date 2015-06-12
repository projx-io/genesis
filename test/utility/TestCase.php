<?php

namespace Test\Utility;

use Mockery;
use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    public function mock($class = null, array $methods = [])
    {
        $mock = $class ? Mockery::mock($class) : Mockery::mock();
        $spies = (object)[];
        array_map(function ($method) use ($mock, $spies) {
            return $spies->{$method} = $mock->shouldReceive($method);
        }, $methods);
        $spies->mock = $mock;
        return $spies;
    }

    public function testTrue()
    {
        $this->assertTrue(true);
    }
}
