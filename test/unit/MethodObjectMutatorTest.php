<?php

namespace Projx\Genesis;

use Test\Utility\TestCase;

class MethodObjectMutatorTest extends TestCase
{
    public function dataProvider()
    {
        return [
            ['test', ['a', 'b', 'c']],
            ['test', ['a', 'b', 'c', 'd']],
            ['testMethod', ['a', 'b', 'c']],
            ['testMethod', ['a', 'b', 'c', 'd']],
            ['someMethod', ['a', 'b', 'c']],
            ['someMethod', ['a', 'b', 'c', 'd']],
        ];
    }

    /**
     * @param string $method
     * @param array $arguments
     * @dataProvider dataProvider
     */
    public function testMakeFakeClass($method, $arguments)
    {
        $object = $this->mock(null, [$method]);
        $object->{$method}->withArgs($arguments)->once();
        $mutator = new MethodObjectMutator();
        $mutator->set($object->mock, $method, $arguments);

//        $object = $this->mock();
//        $nextMutator = $this->mock('Projx\Genesis\ObjectMutator', ['set']);
//        $nextMutator->set->with($object, $method, $arguments)->once();
//        $mutator = new MethodMutator($method, $nextMutator->mock);
//        $actual = $mutator->set($object, $arguments);
//        $this->assertEquals($mutator, $actual);
    }
}
