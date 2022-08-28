<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->functions->CountArgumentsWrapper([1]);
    }
}
