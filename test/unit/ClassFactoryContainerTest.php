<?php

namespace Projx\Genesis;

use Test\Utility\TestCase;

class ClassFactoryContainerTest extends TestCase
{
    public function dataProvider()
    {
        $classA = 'Test\Fake\FakeClassA';
        $classB = 'Test\Fake\FakeNamespace\FakeClassB';
        $classC = 'Test\Fake\FakeNamespace\AnotherFakeNamespace\FakeClassC';

        $class = 'Projx\Genesis\Factory';
        $methods = ['make'];

        $factoryA = $this->mock($class, $methods);
        $factoryB = $this->mock($class, $methods);
        $factoryC = $this->mock($class, $methods);

        $factories = [
            $classA => $factoryA->mock,
            $classB => $factoryB->mock,
            $classC => $factoryC->mock,
        ];

        return [
            [$factories, $factoryA, $classA, ['a', 'b', 'c']],
            [$factories, $factoryA, $classA, ['a', 'b', 'c', 'd']],
            [$factories, $factoryB, $classB, ['a', 'b', 'c']],
            [$factories, $factoryB, $classB, ['a', 'b', 'c', 'd']],
            [$factories, $factoryC, $classC, ['a', 'b', 'c']],
            [$factories, $factoryC, $classC, ['a', 'b', 'c', 'd']],
        ];
    }

    /**
     * @param $factories
     * @param $nextFactory
     * @param string $class
     * @param array $arguments
     * @dataProvider dataProvider
     */
    public function testMakeFakeClass($factories, $nextFactory, $class, $arguments)
    {
        $expect = $this->mock($class);
        $nextFactory->make->with($arguments)->once()->andReturn($expect);
        $factory = new ClassFactoryContainer($factories);
        $actual = $factory->make($class, $arguments);
        $this->assertEquals($expect, $actual);
    }
}
