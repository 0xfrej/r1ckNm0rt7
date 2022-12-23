<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Mapper;

use App\Infrastructure\ApiClient\DataMapper\AbstractDataMapper;
use App\Infrastructure\Dto\LocationReference;
use App\Service\RickAndMortyApi\ApiClient\Transformer\UrlToIntIdTransformer;

/**
 * @extends AbstractDataMapper<LocationReference, array<string, mixed>>
 */
class LocationReferenceMapper extends AbstractDataMapper
{
    public function __construct(
        protected UrlToIntIdTransformer $urlToIntTransformer
    ) {
    }

    /**
     * @inheritDoc
     */
    public function mapOne(array $entity): LocationReference
    {
        return new LocationReference(
            $this->urlToIntTransformer->transform($entity['url']),
            $entity['name']
        );
    }
}
