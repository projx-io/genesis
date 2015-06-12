<?php

namespace Projx\Genesis;

class ReflectionFactoryTest extends TestCase
{
    public function dataProvider()
    {
        return [
            ['Projx\Genesis\FakeClassA', ['a', 'b', 'c']],
            ['Projx\Genesis\FakeClassA', ['a', 'b', 'c', 'd']],
            ['Projx\Genesis\FakeNamespace\FakeClassB', ['a', 'b', 'c']],
            ['Projx\Genesis\FakeNamespace\FakeClassB', ['a', 'b', 'c', 'd']],
            ['Projx\Genesis\FakeNamespace\AnotherFakeNamespace\FakeClassC', ['a', 'b', 'c']],
            ['Projx\Genesis\FakeNamespace\AnotherFakeNamespace\FakeClassC', ['a', 'b', 'c', 'd']],
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
