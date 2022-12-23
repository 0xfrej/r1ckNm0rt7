<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Response;

use App\Infrastructure\ApiClient\Pagination\IPagination;

/**
 * @template T of object
 * @extends IDataResponse<array<T>>
 */
interface IPaginatedResponse extends IDataResponse
{
    /**
     * Gets pagination data from response
     */
    public function getPagination(): IPagination;
}
