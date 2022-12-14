<?php
/**
 * Create Class - Scrapper with method getMovie().
 * getMovie() - should return Movie Class object.
 *
 * Note: Use next namespace for Scrapper Class - "namespace src\oop\app\src;"
 * Note: Dont forget to create variables for TransportInterface and ParserInterface objects.
 * Note: Also you can add your methods if needed.
 */
namespace src\oop\app\src;

use src\oop\app\src\Models\Movie;
use src\oop\app\src\Transporters\TransportInterface;
use src\oop\app\src\Parsers\ParserInterface;

class Scrapper
{
    private TransportInterface $transporter;
    private ParserInterface $parser;

    public function __construct($transporter, $parser)
    {
        $this->transporter = $transporter;
        $this->parser = $parser;
    }

    public function getMovie($link): object
    {
        $movieBody = $this->transporter->getContent($link);
        $movieContent = $this->parser->parseContent($movieBody);

        $movie = new Movie;

        $movie->setTitle($movieContent['title']);
        $movie->setPoster($movieContent['poster']);
        $movie->setDescription($movieContent['description']);

        return $movie;
    }
}
