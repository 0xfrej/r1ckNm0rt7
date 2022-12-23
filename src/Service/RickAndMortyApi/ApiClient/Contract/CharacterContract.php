<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Contract;

use App\Infrastructure\ApiClient\Response\IDataResponse;
use App\Infrastructure\ApiClient\Response\IResponse;

interface CharacterContract
{
    public const BASE_PATH = '/api/character';

    /**
     * Get character by ID
     *
     * @psalm-return IResponse|IDataResponse<Character>
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\CharacterNotFoundException
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getById(int $id): IResponse|IDataResponse;

    /**
     * Get multiple characters by ID
     *
     * @psalm-return IResponse|IDataResponse<array<Character>>
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getByMultipleIds(int ...$id): IResponse|IDataResponse;
}
