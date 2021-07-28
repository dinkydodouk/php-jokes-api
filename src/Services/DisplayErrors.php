<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class DisplayErrors
{
    public static function displayErrors($message, $statusCode): Response
    {
        $response = new Response();
        $response->setContent(json_encode(['message' => $message]));
        $response->setStatusCode($statusCode);

        return $response;
    }
}