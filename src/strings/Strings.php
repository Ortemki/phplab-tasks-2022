<?php

namespace strings;

class Strings implements StringsInterface
{
    public function snakeCaseToCamelCase(string $input): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }

    public function mirrorMultibyteString(string $input): string
    {
        $wordsArr = explode(' ', $input);
        $new_string = [];

        foreach ($wordsArr as $word) {
            $new_string[] = iconv('utf-16be', 'utf-8', strrev(iconv('utf-8', 'utf-16le', $word)));
        }

        return implode(" ", $new_string);
    }

    public function getBrandName(string $noun): string
    {
        return $noun[0] === $noun[-1] ? ucfirst($noun) . substr($noun, 1) : "The " . ucfirst($noun);
    }
}
