<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Mapper;

use App\Infrastructure\ApiClient\DataMapper\AbstractDataMapper;
use App\Infrastructure\ApiClient\DataTransformer\StringDateTimeTransformer;
use App\Infrastructure\Dto\Episode;
use App\Service\RickAndMortyApi\ApiClient\Transformer\UrlToIntIdTransformer;

/**
 * @extends AbstractDataMapper<Episode, array<string,mixed>>
 */
class EpisodeMapper extends AbstractDataMapper
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
        return new Episode(
            $entity['id'],
            $entity['name'],
            $this->strDateTransformer->transform($entity['air_date']),
            $entity['episode'],
            $this->urlToIntTransformer->transformList($entity['characters']),
            $this->strDateTransformer->transform($entity['created']),
        );
    }
}
