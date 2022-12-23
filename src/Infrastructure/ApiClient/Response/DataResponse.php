<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Response;

/**
 * @template T
 * @extends IDataResponse<T>
 */
class DataResponse extends Response implements IDataResponse
{
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
    public function getResponseData(): object|array
    {
        return $this->data;
    }
}
