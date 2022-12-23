<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Mapper;

use App\Infrastructure\ApiClient\DataMapper\AbstractDataMapper;
use App\Infrastructure\ApiClient\DataTransformer\StringDateTimeTransformer;
use App\Infrastructure\Dto\Location;
use App\Service\RickAndMortyApi\ApiClient\Transformer\UrlToIntIdTransformer;

/**
 * @extends AbstractDataMapper<Location, array<string, mixed>>
 */
class LocationMapper extends AbstractDataMapper
{
    public function __construct(
        protected UrlToIntIdTransformer $urlToIntTransformer,
        protected StringDateTimeTransformer $strDateTransformer
    ) {
    }

    /**
     * @inheritDoc
     */
    public function mapOne(array $entity): object
    {
        return new Location(
            $entity['id'],
            $entity['name'],
            $entity['type'],
            $entity['dimension'],
            $this->urlToIntTransformer->transformList($entity['residents']),
            $this->strDateTransformer->transform($entity['created'])
        );
    }
}
