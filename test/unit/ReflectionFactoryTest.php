<?php

namespace Projx\Genesis;

use Test\Utility\TestCase;

class ReflectionFactoryTest extends TestCase
{
    public function dataProvider()
    {
        return [
            ['Test\Fake\FakeClassA', ['a', 'b', 'c']],
            ['Test\Fake\FakeClassA', ['a', 'b', 'c', 'd']],
            ['Test\Fake\FakeNamespace\FakeClassB', ['a', 'b', 'c']],
            ['Test\Fake\FakeNamespace\FakeClassB', ['a', 'b', 'c', 'd']],
            ['Test\Fake\FakeNamespace\AnotherFakeNamespace\FakeClassC', ['a', 'b', 'c']],
            ['Test\Fake\FakeNamespace\AnotherFakeNamespace\FakeClassC', ['a', 'b', 'c', 'd']],
        ];
    }

    /**
     * @param string $class
     * @param array $arguments
     * @dataProvider dataProvider
     */
    public function testMakeFakeClass($class, $arguments)
    {
        $factory = new ReflectionFactory($class);
        $actual = $factory->make($arguments);
        $this->assertInstanceOf($class, $actual);
        $this->assertEquals($actual->arguments, $arguments);
    }
}
