<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi;

use App\Infrastructure\ApiClient\Filter\FilterCollection;
use App\Infrastructure\ApiClient\Filter\IFilterCollection;
use App\Infrastructure\Dto\Character;
use App\Service\RickAndMortyApi\ApiClient\Contract\CharacterContract;
use App\Service\RickAndMortyApi\ApiClient\Contract\EpisodeContract;
use App\Service\RickAndMortyApi\ApiClient\Contract\LocationContract;
use App\Service\RickAndMortyApi\ApiClient\Exception\EpisodeNotFoundException;
use App\Service\RickAndMortyApi\ApiClient\Exception\LocationNotFoundException;

class RickAndMortyFacade implements IRickAndMortyFacade
{
    protected const REGEX_EPISODE = "/S\d{2}E\d{2}/";

    public function __construct(
        protected CharacterContract $character,
        protected EpisodeContract $episode,
        protected LocationContract $location
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getCharacterById(int $id): Character
    {
        return $this->character->getById($id)
            ->getResponseData();
    }

    /**
     * @inheritDoc
     */
    public function getCharactersInDimension(string $dimensionName): array
    {
        $filters = FilterCollection::make()
            ->set(LocationContract::FILTER_DIMENSION, $dimensionName);

        $characterIdList = [];
        do {
            $response = $this->location->getList($filters);

            /** @var \App\Infrastructure\Dto\Location $firstLocation */
            $firstLocation = $response->getResponseData()[0];
            if (
                $response->getPagination()->totalEntities() === 0 ||
                $firstLocation->getDimension() !== $dimensionName
            ) {
                throw new LocationNotFoundException(
                    sprintf("Could not find dimension '%s'", $dimensionName)
                );
            }

            /** @var \App\Infrastructure\Dto\Location $location */
            foreach ($response->getResponseData() as $location) {
                // Stop scanning more entities beacause we are looking only for exact matches
                if ($location->getDimension() !== $dimensionName) {
                    break 2;
                }
                $characterIdList = array_merge($characterIdList, $location->getResidents());
            }
            $filters->set(LocationContract::FILTER_PAGE, (string) $response->getPagination()->next());
        } while ($response->getPagination()->hasNext());

        if (! empty($characterIdList)) {
            $response = $this->character->getByMultipleIds(...$characterIdList);

            return $response->getResponseData();
        }

        return [];
    }

    /**
     * @inheritDoc
     */
    public function getCharactersAtLocation(string $locationName): array
    {
        $filters = FilterCollection::make()
            ->set(LocationContract::FILTER_NAME, $locationName);

        $response = $this->location->getList($filters);

        /** @var \App\Infrastructure\Dto\Location $firstLocation */
        $firstLocation = $response->getResponseData()[0];
        if (
            $response->getPagination()->totalEntities() === 0 ||
            $firstLocation->getName() !== $locationName
        ) {
            throw new LocationNotFoundException(
                sprintf("Could not find location '%s'", $locationName)
            );
        }

        $characterIdList = $firstLocation->getResidents();
        if (! empty($characterIdList)) {
            $response = $this->character->getByMultipleIds(...$characterIdList);

            return $response->getResponseData();
        }

        return [];
    }

    /**
     * @inheritDoc
     */
    public function getCharactersInEpisode(string $episodeName): array
    {
        $filters = $this->createEpisodeFilter($episodeName);

        $characterIdList = [];
        do {
            $response = $this->episode->getList($filters);
            if ($response->getPagination()->totalEntities() === 0) {
                throw new EpisodeNotFoundException(
                    sprintf("Could not find episode '%s'", $episodeName)
                );
            }

            /** @var \App\Infrastructure\Dto\Episode $episode */
            foreach ($response->getResponseData() as $episode) {
                $characterIdList = array_merge($characterIdList, $episode->getCharacters());
            }

            $filters->set(LocationContract::FILTER_PAGE, (string) $response->getPagination()->next());
        } while ($response->getPagination()->hasNext());

        if (! empty($characterIdList)) {
            $response = $this->character->getByMultipleIds(...$characterIdList);

            return $response->getResponseData();
        }

        return [];
    }

    protected function createEpisodeFilter(string $nameOrCode): IFilterCollection
    {
        $filters = FilterCollection::make();

        if (preg_match(self::REGEX_EPISODE, $nameOrCode)) {
            return $filters
                ->set(EpisodeContract::FILTER_EPISODE_CODE, $nameOrCode);
        }
        return $filters
            ->set(EpisodeContract::FILTER_NAME, $nameOrCode);
    }
}
