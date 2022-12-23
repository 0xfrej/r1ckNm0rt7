<?php

declare(strict_types=1);

namespace App\Event;

use App\Dto\Api\ApiError;
use App\Dto\Api\ApiResult;
use App\Infrastructure\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\SerializerInterface;

class ExceptionResponseListener
{
    public function __construct(
        protected SerializerInterface $serializer
    ) {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($exception instanceof NotFoundException) {
            $status = Response::HTTP_NOT_FOUND;
        }

        $json = $this->serializer->serialize(
            ApiResult::make(null, [ApiError::make($exception->getMessage())]),
            'json',
            [
                'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
            ]
        );

        $event->setResponse(
            new JsonResponse($json, $status, [], true)
        );
    }
}
