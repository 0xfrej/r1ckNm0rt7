<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient;

use App\Infrastructure\ApiClient\AdapterInterface;
use App\Infrastructure\ApiClient\Exception\ApiClientException;
use App\Infrastructure\ApiClient\Request\IRequestFactory;
use Psr\Http\Message\StreamInterface;

abstract class AbstractContractImplementor
{
    public function __construct(
        protected AdapterInterface $adapter,
        protected IRequestFactory $requestFactory,
    ) {
    }

    protected function joinPaths(string ...$strings): string
    {
        return implode('/', $strings);
    }

    /**
     * @return array<string|int,mixed>
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    protected function deserializeResponse(StreamInterface $body): array
    {
        $bodySize = $body->getSize();

        if ($bodySize === null) {
            throw new ApiClientException("Response body has unknown lenght! Cannot deserialize!");
        }
        try {
            return json_decode(
                $body->read($bodySize),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\JsonException $e) {
            throw new ApiClientException(
                sprintf("Failed to deserialize json from body due to: %s", $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }
}
