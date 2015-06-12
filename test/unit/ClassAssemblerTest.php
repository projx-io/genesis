<?php

namespace Projx\Genesis;

use Test\Utility\TestCase;

class ClassAssemblerTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [
                ['a', 'b'],
                [
                    'test' => ['a', 'b', 'c'],
                ],
            ]
        ];
    }

    /**
     * @param array $arguments
     * @param array $mutations
     * @dataProvider dataProvider
     */
    public function testMakeFakeClass($arguments, $mutations)
    {
        $expect = $this->mock();
        $factory = $this->mock('Projx\Genesis\Factory', ['make']);
        $factory->make->with($arguments)->once()->andReturn($expect);
        $mutator = $this->mock('Projx\Genesis\ObjectMutator');
        array_map(function ($arguments, $method) use ($expect, $mutator) {
            $mutator->mock->shouldReceive('set')->with($expect, $method, $arguments)->once();
        }, $mutations, array_keys($mutations));
        $assembler = new ClassAssembler($factory->mock, $mutator->mock);
        $assembler->arguments($arguments);
        array_map(function ($arguments, $method) use ($assembler) {
            $assembler->mutation($method, $arguments);
        }, $mutations, array_keys($mutations));
        $actual = $assembler->build();
        $this->assertEquals($expect, $actual);
    }
}
