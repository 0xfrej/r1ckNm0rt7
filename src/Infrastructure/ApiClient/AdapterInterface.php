<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface AdapterInterface
{
    /**
     * Call the request
     *
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function call(RequestInterface $request): ResponseInterface;
}
