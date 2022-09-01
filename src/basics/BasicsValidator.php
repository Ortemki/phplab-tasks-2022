<?php

namespace basics;

class BasicsValidator implements BasicsValidatorInterface
{

    public function isMinutesException(int $minute): void
    {
        if (!in_array($minute, range(0,59))) {
            throw new \InvalidArgumentException();
        }
    }

    public function isYearException(int $year): void
    {
        if ($year < 1900) {
            throw new \InvalidArgumentException();
        }
    }

    public function isValidStringException(string $input): void
    {
        if (mb_strlen($input) > 6) {
            throw new \InvalidArgumentException();
        }
    }
}
