<?php

namespace src\oop\app\src\Parsers;

class FilmixParserStrategy implements ParserInterface
{
    public function parseContent(string $siteContent)
    {
        preg_match_all('#<h1 class="name" itemprop="name">(.*)</h1>#', $siteContent, $title);
        preg_match_all('#<a class="fancybox" rel="group" href="(.*)">#', $siteContent, $poster);
        preg_match_all('#<div class="full-story">(.*)</div>#', $siteContent, $description);

        $decodeTitle = iconv('windows-1251', 'UTF-8', $title[0][0]);
        $decodeDescription = strip_tags(iconv('windows-1251', 'UTF-8', $description[0][0]));

        return [
            'title' => $decodeTitle,
            'poster' => $poster[1][0],
            'description' => $decodeDescription
        ];
    }
}
