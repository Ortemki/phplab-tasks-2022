<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->functions->sayHelloArgument($input));
    }

    public function positiveDataProvider()
    {
        return [
            [5, 'Hello 5'],
            ['Artem', 'Hello Artem'],
            [true, 'Hello 1']
        ];
    }
}
