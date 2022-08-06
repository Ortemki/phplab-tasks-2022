<?php


namespace strings;


class Strings implements StringsInterface
{

    public function snakeCaseToCamelCase(string $input): string
    {
        $firstStr = mb_convert_case(str_replace("_", " ", $input), MB_CASE_TITLE);
        return lcfirst(str_replace(" ", "", $firstStr));
    }

    public function mirrorMultibyteString(string $input): string
    {
        $wordsArr = explode(" ", $input);
        $new_string = [];
        foreach ($wordsArr as $word){
            $new_string[] = iconv('utf-16be', 'utf-8', strrev(
                iconv('utf-8', 'utf-16le', $word)
            ));
        }
        return implode(" ", $new_string);
    }

    public function getBrandName(string $noun): string
    {
        $firstLetter = $noun[0];
        $lastLetter = $noun[-1];
        if($firstLetter === $lastLetter) {
            return ucfirst($noun) . substr($noun, 1);
        }else{
            return "The " . ucfirst($noun);
        }
    }
}