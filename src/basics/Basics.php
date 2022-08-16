<?php

namespace basics;

use Webmozart\Assert\InvalidArgumentException;

class Basics implements BasicsInterface
{
    private $validator;

    public function __construct(BasicsValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getMinuteQuarter(int $minute): string
    {
        $this->validator->isMinutesException($minute);

        if(in_array($minute, range(1,15))){
            return 'first';
        } elseif (in_array($minute, range(16,30))) {
            return 'second';
        } elseif (in_array($minute, range(31,45))) {
            return 'third';
        } elseif ((in_array($minute, range(46,59))) or $minute === 0) {
            return 'fourth';
        }
    }

    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);

        return date("L", mktime(0, 0, 0, 7, 7, $year));
    }

    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);

        $firstPart = array_sum(str_split(mb_strcut($input, 0, 3)));
        $secondPart = array_sum(str_split(mb_strcut($input, 3, 3)));
        return $firstPart == $secondPart;
    }
}
