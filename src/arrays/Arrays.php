<?php

namespace arrays;

class Arrays implements ArraysInterface
{
    public function repeatArrayValues(array $input): array
    {
        $result = [];

        foreach($input as $number){
            for($i = 1; $i <= $number; $i++){
                $result[] = $number;
            }
        }

        return $result;
    }

    public function getUniqueValue(array $input): int
    {
        if (empty($input)) {
            $result = 0;
        } else {
            $noRepeatNumbers = array_unique($input);
            $duplicates = array_diff_assoc($input, $noRepeatNumbers);
            $uniqueValues = array_diff($input, $duplicates);
            $result = !empty($uniqueValues) ? min($uniqueValues) : 0;
        }

        return $result;
    }

    public function groupByTag(array $input): array
    {
        $result = [];

        foreach ($input as $product){
            foreach ($product['tags'] as $tag){
                $result[$tag][] = $product['name'];
            }
        }

        array_walk($result, function (&$value) {
            sort($value);
        });

        ksort($result);

        return $result;
    }
}
