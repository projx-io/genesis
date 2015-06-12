<?php

namespace Projx\Genesis;

use Test\Utility\TestCase;

class FactoryBuilderTest extends TestCase
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
    public function testMakeFakeClassA($class, $arguments)
    {
        $factory = $this->mock('Projx\Genesis\ClassFactory', ['make']);
        $factory->make->with($class, $arguments)->once()->andReturn($this->mock($class)->mock);
        $builder = new FactoryBuilder($factory->mock);
        $builder->name($class);
        array_map([$builder, 'argument'], $arguments);
        $actual = $builder->build();
        $this->assertInstanceOf($class, $actual);
    }
}
