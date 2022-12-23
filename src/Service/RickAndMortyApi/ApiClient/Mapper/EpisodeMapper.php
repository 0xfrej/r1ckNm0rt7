<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Mapper;

use App\Infrastructure\ApiClient\DataMapper\AbstractDataMapper;
use App\Infrastructure\ApiClient\DataTransformer\StringDateTimeTransformer;
use App\Infrastructure\Dto\Episode;
use App\Service\RickAndMortyApi\ApiClient\Transformer\UrlToIntIdTransformer;

/**
 * @extends BasicDataMapper<Episode, array<string, mixed>>
 */
class EpisodeMapper extends AbstractDataMapper
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
        return new Episode(
            $entity['id'],
            $entity['name'],
            $this->stringDateTimeTransformer->transform($entity['air_date']),
            $entity['episode'],
            $this->urlToIntTransformer->transformList($entity['characters']),
            $this->stringDateTimeTransformer->transform($entity['created']),
        );
    }
}
