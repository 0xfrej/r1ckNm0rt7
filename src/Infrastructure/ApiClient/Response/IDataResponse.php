<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Response;

/**
 * Interface for responses containing data
 *
 * @template T of object|array<object>
 */
interface IDataResponse extends IResponse
{
    /**
     * Get data from response
     *
     * @psalm-return T
     */
    public function getResponseData(): mixed;
}
