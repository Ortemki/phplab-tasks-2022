<?php

namespace src\oop\app\src\Transporters;

use GuzzleHttp\Client;

class GuzzleAdapter implements TransportInterface
{
    public function getContent(string $url): string
    {
        $client = new Client();

        $response = $client->request('GET', $url);

        return $response->getBody()->getContents();
    }
}
