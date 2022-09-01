<?php

namespace src\oop\app\src\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    public function parseContent(string $siteContent)
    {
        $crawler = new Crawler($siteContent);

        $title = $crawler->filter('h1')->text();
        $poster = $crawler->filter('div.fposter > a')->eq(0)->attr('href');
        $description = $crawler->filter('.fdesc')->text();

        return [
            'title' => $title,
            'poster' => $poster,
            'description' => $description
        ];
    }
}
