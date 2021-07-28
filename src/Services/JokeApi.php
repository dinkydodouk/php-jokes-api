<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class JokeApi
{
    public static function fetchJokes(Int $number)
    {
        $client = HttpClient::create();

        $response = $client->request(
            "GET",
            "https://v2.jokeapi.dev/joke/Any?format=json&amount=$number"
        );

        $code = $response->getStatusCode();

        if($code == 200 && !empty($response->getContent())) {
            $jsonResult = json_decode($response->getContent());

            if(!empty($jsonResult)) {
                if(isset($jsonResult->jokes)) {
                    $object = [];
                    foreach($jsonResult->jokes as $key => $val) {
                        if($val->type == 'twopart') {
                            $object[$key]['setup'] = $val->setup;
                            $object[$key]['joke'] = $val->delivery;
                        } else {
                            $object[$key]['setup'] = '';
                            $object[$key]['joke'] = $val->joke;
                        }
                    }

                    return $object;
                } else {
                    $object = [];
                    if($jsonResult->type == 'twopart') {
                        $object[0]['setup'] = $jsonResult->setup;
                        $object[0]['joke'] = $jsonResult->delivery;
                    } else {
                        $object[0]['setup'] = '';
                        $object[0]['joke'] = $jsonResult->joke;
                    }

                    return $object;
                }
            } else {
                throw new \Exception("No results");
            }
        } else {
            throw new \Exception("There was an error connecting to the Joke API. Error Number " . $response->getStatusCode(), $response->getStatusCode());
        }
    }
}