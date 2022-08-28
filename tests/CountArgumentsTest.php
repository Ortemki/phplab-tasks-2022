<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider noArgumentsProvider
     */
    public function testNoArguments($input, $expected)
    {
        $this->assertEquals($expected, $this->functions->countArguments($input));
    }

    public function noArgumentsProvider(): array
    {
        return[
            [[],['argument_count' => 1, 'argument_values' => array(array())]]
        ];
    }

    /**
     * @dataProvider oneStringProvider
     */
    public function testOneStringPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->functions->countArguments($input));
    }

    public function oneStringProvider(): array
    {
        return [
            ['a', ['argument_count' => 1, 'argument_values' => array('a')]]
        ];
    }

    /**
     * @dataProvider coupleStringsProvider
     */

    public function testCoupleStringsPositive($input1, $input2, $expected)
    {
        $this->assertEquals($expected, $this->functions->countArguments($input1, $input2));
    }

    public function coupleStringsProvider(): array
    {
        return [
            ['a', 'b', ['argument_count' => 2, 'argument_values' => array('a','b')]]
        ];
    }
}
