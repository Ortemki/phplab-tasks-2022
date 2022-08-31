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
     * @dataProvider positiveDataProvider
     */
    public function testPositive(array $input, array $expected)
    {
        $this->assertEquals($expected, $this->functions->countArguments($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [[],['argument_count' => 1, 'argument_values' => array(array())]],
            [['a'], ['argument_count' => 1, 'argument_values' => array(array('a'))]],
            [['a', 'b'], ['argument_count' => 1, 'argument_values' => array(array('a','b'))]]
        ];
    }
}
