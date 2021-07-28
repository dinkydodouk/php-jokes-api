<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class OfficialJokeApi
{
    private static function fetchOneJoke()
    {
        $client = HttpClient::create();

        $response = $client->request(
            "GET",
            "https://official-joke-api.appspot.com/jokes/random"
        );

        $code = $response->getStatusCode();

        if($code == 200 && !empty($response->getContent())) {
            $jsonResult = json_decode($response->getContent());

            if(!empty($jsonResult)) {
                return $jsonResult;
            } else {
                throw new \Exception("No results");
            }
        } else {
            throw new \Exception("There was an error connecting to Official Joke's API on Appspot. Error Number " . $response->getStatusCode(), $response->getStatusCode());
        }
    }

    public static function fetchJokes(Int $number)
    {
        if($number === 1) {
            self::fetchOneJoke();
            exit;
        }

        // SWITCH INTEGER TO STRING FOR THE NUMBER
        $numberToWord = self::numberToWords($number);

        $client = HttpClient::create();

        $response = $client->request(
            "GET",
            "https://official-joke-api.appspot.com/jokes/$numberToWord"
        );

        echo "https://official-joke-api.appspot.com/jokes/$numberToWord";

        $code = $response->getStatusCode();

        if($code == 200 && !empty($response->getContent())) {
            $jsonResult = json_decode($response->getContent());

            if(!empty($jsonResult)) {
                return $jsonResult;
            } else {
                throw new \Exception("No results");
            }
        } else {
            throw new \Exception("There was an error connecting to Chuck's API. Error Number " . $response->getStatusCode(), $response->getStatusCode());
        }
    }

    private static function numberToWords($number)
    {
        $nWords = ["zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty"];

        foreach($nWords as $k => $v) {
            if($k === $number) {
                return $v;
            }
        }
    }
}