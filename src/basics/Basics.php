<?php

namespace basics;

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

        if($minute >= 1 && $minute <=15){
            return 'first';
        }elseif($minute >= 16 && $minute <=30){
            return 'second';
        }elseif($minute >= 31 && $minute <=45){
            return 'third';
        }elseif(($minute >= 46 && $minute <= 59) || $minute === 0){
            return 'fourth';
        }
    }

    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);

        return ($year % 400 === 0) || (($year % 100 !== 0) && ($year % 4 === 0));
    }

    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);

        $firstPart = array_sum(str_split(mb_strcut($input, 0, 3)));
        $secondPart = array_sum(str_split(mb_strcut($input, 3, 3)));

        return $firstPart == $secondPart;
    }
}
