<?php

namespace Projx\Genesis;

use Test\Utility\TestCase;

class ConfigurationDirectorTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [['a', 'b', 'c'], [['test', ['a', 'b']]]],
            [['a', 'b', 'c', 'd'], [['test', ['a', 'b']]]],
            [['a', 'b', 'c', 'd'], [
                ['test', ['a', 'b']],
                ['something', ['a', 'b', 'd']]
            ]],
        ];
    }

    /**
     * @param array $args
     * @param array $calls
     * @dataProvider dataProvider
     */
    public function testMakeFakeClass($args, $calls)
    {
        $script = (object)['args' => $args, 'calls' => $calls];
        $expect = $this->mock();
        $assembler = $this->mock('Projx\Genesis\Assembler', ['arguments', 'build']);
        $assembler->arguments->with($args)->once();
        $assembler->build->once()->andReturn($expect);
        array_map(function ($call) use ($assembler) {
            $assembler->mock->shouldReceive('mutation')->withArgs($call)->once();
        }, $calls);
        $director = new ConfigurationDirector($assembler->mock);
        $director->direct($script);
        $actual = $director->build();
        $this->assertEquals($expect, $actual);
    }
}
