<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Contract;

use App\Infrastructure\ApiClient\Filter\FilterCollection;
use App\Infrastructure\ApiClient\Response\IDataResponse;
use App\Infrastructure\ApiClient\Response\IPaginatedResponse;
use App\Infrastructure\ApiClient\Response\IResponse;
use App\Infrastructure\Dto\Location;

interface LocationContract
{
    public const BASE_PATH = '/api/location';

    public const FILTER_NAME = 'name';
    public const FILTER_TYPE = 'type';
    public const FILTER_DIMENSION = 'dimension';
    public const FILTER_PAGE = 'page';

    /**
     * Get location list
     *
     * @psalm-return IResponse|IDataResponse<array<Location>>|IPaginatedResponse<Location>
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getList(?FilterCollection $filters): IResponse|IDataResponse|IPaginatedResponse;
}
