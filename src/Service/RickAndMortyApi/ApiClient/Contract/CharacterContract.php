<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Contract;

use App\Infrastructure\ApiClient\Response\IDataResponse;
use App\Infrastructure\Dto\Character;

interface CharacterContract
{
    public const BASE_PATH = '/api/character';

    /**
     * Get character by ID
     *
     * @psalm-return IDataResponse<Character>
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\CharacterNotFoundException
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getById(int $id): IDataResponse;

    /**
     * Get multiple characters by ID
     *
     * @psalm-return IDataResponse<array<Character>>
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getByMultipleIds(int ...$id): IDataResponse;
}
