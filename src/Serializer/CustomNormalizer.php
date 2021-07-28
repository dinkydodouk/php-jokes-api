<?php

namespace App\Serializer;

use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CustomNormalizer implements NormalizerInterface
{
    public function normalize($exception, string $format = null, array $context = [], string $message = null)
    {
        if($message == NULL) {
            $message = $exception->getMessage();
        }

        return [
            'message' => $message,
            'code' => $exception->getStatusCode()
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof FlattenException;
    }
}