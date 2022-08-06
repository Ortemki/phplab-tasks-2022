<?php

namespace  basics;


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

        if($minute >= 1 AND $minute <=15){
            return 'first';
        }elseif($minute >= 16 AND $minute <=30){
            return 'second';
        }elseif($minute >= 31 AND $minute <=45){
            return 'third';
        }elseif(($minute >= 46 AND $minute <= 59) OR $minute === 0){
            return 'fourth';
        }
    }

    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);
        $leapYear = date("L", mktime(0,0,0, 7,7, $year));
        switch ($leapYear) {
            case 0:
                return false;
                break;
            case 1:
                return true;
                break;
        }
    }

    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);
        $firstPart = array_sum(str_split(mb_strcut($input,0,3)));
        $secondPart = array_sum(str_split(mb_strcut($input,3,3)));
        if($firstPart == $secondPart){
            return true;
        }else{
            return false;
        }
    }
}