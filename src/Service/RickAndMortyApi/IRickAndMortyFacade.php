<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi;

use App\Infrastructure\Dto\Character;

interface IRickAndMortyFacade
{
    /**
     * Get character by it's ID
     *
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\CharacterNotFoundException
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getCharacterById(int $id): Character;

    /**
     * Get a list of characters that reside within given dimension
     *
     * @return array<Character>
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\LocationNotFoundException
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getCharactersInDimension(string $dimensionName): array;

    /**
     * Get a list of characters that reside at given location
     *
     * @return array<Character>
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\LocationNotFoundException
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getCharactersAtLocation(string $locationName): array;

    /**
     * Get a list of characters that reside within given dimension
     *
     * @param string $episodeName accepts episode name as well as episode code in format S##E## (i.e.: S01E02)
     * @return array<Character>
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\EpisodeNotFoundException
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    public function getCharactersInEpisode(string $episodeName): array;
}
