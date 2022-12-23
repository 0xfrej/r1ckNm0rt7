<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Response;

use App\Infrastructure\ApiClient\Pagination\IPagination;

/**
 * @template T of object
 * @extends DataResponse<array<T>>
 * @implements IPaginatedResponse<T>
 */
class PaginatedResponse extends DataResponse implements IPaginatedResponse
{
    /**
     * @psalm-param array<T> $data
     */
    public function __construct(
        bool $isError,
        int $httpCode,
        array $data,
        protected IPagination $pagination
    ) {
        parent::__construct($isError, $httpCode, $data);
    }

    /**
     * @inheritDoc
     */
    public function getPagination(): IPagination
    {
        return $this->pagination;
    }
}
