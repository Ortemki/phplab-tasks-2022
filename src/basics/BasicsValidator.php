<?php


namespace  basics;


class BasicsValidator implements BasicsValidatorInterface
{

    public function isMinutesException(int $minute): void
    {
        try{
            if($minute < 0 OR $minute > 59){
                throw new \InvalidArgumentException();
            }
        }catch(\InvalidArgumentException $e){
            die();
        }
    }

    public function isYearException(int $year): void
    {
        try{
            if($year < 1900){
                throw new \InvalidArgumentException();
            }
        }catch(\InvalidArgumentException $e){
            die();
        }
    }

    public function isValidStringException(string $input): void
    {
        try{
            if(strlen($input) > 6 ){
                throw new \InvalidArgumentException();
            }
        }catch(\InvalidArgumentException $e){
            die();
        }
    }
}
















