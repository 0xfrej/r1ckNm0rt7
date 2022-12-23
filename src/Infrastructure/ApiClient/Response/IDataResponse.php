<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Response;

/**
 * Interface for responses containing data
 *
 * @template T
 */
interface IDataResponse
{
    /**
     * Get data from response
     *
     * @psalm-return T
     */
    public function getResponseData(): object|array;
}
