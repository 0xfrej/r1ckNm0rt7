<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Contract;

use App\Infrastructure\ApiClient\Filter\FilterCollection;
use App\Infrastructure\ApiClient\Response\IDataResponse;
use App\Infrastructure\ApiClient\Response\IPaginatedResponse;
use App\Infrastructure\ApiClient\Response\IResponse;
use App\Infrastructure\Dto\Episode;

interface EpisodeContract
{
    public const BASE_PATH = '/api/episode';

    public const FILTER_NAME = 'name';
    public const FILTER_EPISODE_CODE = 'episode';
    public const FILTER_PAGE = 'page';

    /**
     * Get episode list
     *
     * @psalm-return IResponse|IDataResponse<array<Episode>>|IPaginatedResponse<Episode>
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     * @throws
     */
    public function getList(?FilterCollection $filters): IResponse|IDataResponse|IPaginatedResponse;
}
