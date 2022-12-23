<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Contract;

use App\Infrastructure\ApiClient\Filter\IFilterCollection;
use App\Infrastructure\ApiClient\Response\IPaginatedResponse;
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
     * @psalm-return IPaginatedResponse<Episode>
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\EpisodeNotFoundException
     */
    public function getList(?IFilterCollection $filters): IPaginatedResponse;
}
