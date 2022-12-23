<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Response;

/**
 * @template T of object|array<object>
 * @implements IDataResponse<T>
 */
class DataResponse extends Response implements IDataResponse
{
    /**
     * @psalm-param T $data
     */
    public function __construct(
        bool $isError,
        int $httpCode,
        protected object|array $data
    ) {
        parent::__construct($isError, $httpCode);
    }

    /**
     * @inheritDoc
     */
    public function getResponseData(): mixed
    {
        return $this->data;
    }
}
