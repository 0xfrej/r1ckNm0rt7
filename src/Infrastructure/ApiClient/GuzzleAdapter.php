<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient;

use App\Infrastructure\ApiClient\Exception\ApiClientException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleAdapter implements AdapterInterface
{
    public function __construct(
        protected ClientInterface $client
    ) {
    }

    /**
     * @inheritdoc
     */
    public function call(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->client->send($request, ['http_errors' => false]);
        } catch (GuzzleException $e) {
            throw new ApiClientException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
