<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Contract;

use App\Infrastructure\ApiClient\Filter\IFilterCollection;
use App\Infrastructure\ApiClient\Response\IPaginatedResponse;
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
     * @psalm-return IPaginatedResponse<Location>
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getList(?IFilterCollection $filters): IPaginatedResponse;
}
