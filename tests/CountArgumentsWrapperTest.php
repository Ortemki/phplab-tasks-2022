<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
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

        $this->functions->CountArgumentsWrapper($input);
    }

    public function negativeDataProvider(): array
    {
        return [
            [[1], InvalidArgumentException::class],
            [['1', 2], InvalidArgumentException::class],
            [[1, true], InvalidArgumentException::class],
            [[null], InvalidArgumentException::class]
        ];
    }
}
