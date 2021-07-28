<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class ChuckNorris
{
    public static function fetchJokes(Int $number)
    {
        $client = HttpClient::create();

        // This Creates An Asynchronous Call To The Chuck Norris Joke API.
        // The Number Is Determined By The Range Input Type On The Front-End.
        $response = $client->request(
            "GET",
            "http://api.icndb.com/jokes/random/$number"
        );

        // If All Is Well, Continue With Returning The Array
        if ($response->getStatusCode() == 200 && !empty($response->getContent())) {
            $jsonResult = json_decode($response->getContent());

            if (!empty($jsonResult)) {
                return $jsonResult->value;
            } else {
                throw new \Exception("No results", 404);
            }
        } else {
            throw new \Exception("There was an error connecting to the Joke API. Error Number " . $response->getStatusCode(), $response->getStatusCode());
        }
    }
}