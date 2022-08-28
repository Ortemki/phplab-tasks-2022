<?php

namespace src\oop\app\src\Transporters;

class CurlStrategy implements TransportInterface
{
    public function getContent(string $url): string
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        return curl_exec($ch);
    }
}
