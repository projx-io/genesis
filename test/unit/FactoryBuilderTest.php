<?php

namespace Projx\Genesis;

class FactoryBuilderTest extends TestCase
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
