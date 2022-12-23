<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Mapper;

use App\Infrastructure\ApiClient\DataMapper\AbstractDataMapper;
use App\Infrastructure\ApiClient\DataTransformer\StringDateTimeTransformer;
use App\Infrastructure\Dto\Location;
use App\Service\RickAndMortyApi\ApiClient\Transformer\UrlToIntIdTransformer;

/**
 * @extends BasicDataMapper<Location, array<string, mixed>>
 */
class LocationMapper extends AbstractDataMapper
{
    public function __construct(
        protected LocationReferenceMapper $locationReferenceMapper,
        protected UrlToIntIdTransformer $urlToIntTransformer,
        protected StringDateTimeTransformer $stringDateTimeTransformer
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
            $this->stringDateTimeTransformer->transform($entity['created'])
        );
    }
}
