<?php

namespace arrays;

class Arrays implements ArraysInterface
{

    public function repeatArrayValues(array $input): array
    {
        return array_merge($input, array_reverse($input));
    }

    public function getUniqueValue(array $input): int
    {
        if(empty($input)){
            return 0;
        }else{
            $numRepeat = array_count_values($input);
            $unique = [];
            foreach($numRepeat as $number => $count){
                if($count === 1){
                    $unique[] = $number;
                }
            }
            if(empty($unique)){
                return 0;
            }else{
                return min($unique);
            }
        }
    }

    public function groupByTag(array $input): array
    {
        $newArr = [];

        foreach ($input as $ele){
            foreach ($ele['tags'] as $tag){
                $newArr[$tag][] = $ele['name'];
            }
        }

        foreach($newArr as &$tag){
            sort($tag);
        }

        ksort($newArr);

        return $newArr;
    }
}
