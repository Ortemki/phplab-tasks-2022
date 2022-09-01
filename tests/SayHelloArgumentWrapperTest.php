<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider negativeDataProvider
     */
    public function testNegative($input, $expectedException)
    {
        $this->expectException($expectedException);

        $this->functions->sayHelloArgumentWrapper($input);
    }

    public function negativeDataProvider()
    {
        return [
            [[1, 2, 3], InvalidArgumentException::class],
            [null, InvalidArgumentException::class],
            [$this->functions, InvalidArgumentException::class],
        ];
    }

}
