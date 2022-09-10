<?php

use PHPUnit\Framework\TestCase;

require_once './src/web/functions.php';

class GetUniqueFirstLettersTest extends TestCase
{

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [
                [
                    ["name" => "Lanai Airport"],
                    ["name" => "Central Illinois Airport"],
                    ["name" => "Birmingham-Shuttlesworth Airport"]
                ],
                ['B', 'C', 'L']
            ],
            [
                [
                    ["name" => "Hawaii"],
                    ["name" => "Hailey"],
                    ["name" => "Lewiston"],
                    ["name" => "Springfield"],
                    ["name" => "Lafayette"]
                ],
                ['H', 'L', 'S']
            ],
            [
                [
                    ["name" => "Monroe"],
                    ["name" => "Presque Isle"],
                    ["name" => "Salisbury"],
                    ["name" => "Nantucket"],
                    ["name" => "Vineyard Haven"]
                ],
                ['M', 'N', 'P', 'S', 'V']
            ]
        ];
    }
}
