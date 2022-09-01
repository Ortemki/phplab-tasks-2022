<?php

namespace src\oop\app\src\Transporters;

use GuzzleHttp\Client;

class GuzzleAdapter implements TransportInterface
{
    public function getContent(string $url): string
    {
        $client = new Client();

        return $client->get($url)->getBody()->getContents();
    }
}
