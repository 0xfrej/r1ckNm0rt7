<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Mapper;

use App\Infrastructure\ApiClient\DataMapper\AbstractDataMapper;
use App\Infrastructure\ApiClient\DataTransformer\StringDateTimeTransformer;
use App\Infrastructure\Dto\Character;
use App\Service\RickAndMortyApi\ApiClient\Transformer\UrlToIntIdTransformer;

/**
 * @extends BasicDataMapper<Character, array<string, mixed>>
 */
class CharacterMapper extends AbstractDataMapper
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
    public function mapOne(array $entity): Character
    {
        return new Character(
            $entity['id'],
            $entity['name'],
            $entity['status'],
            $entity['species'],
            $entity['type'],
            $entity['gender'],
            $this->locationReferenceMapper->mapOne($entity['origin']),
            $this->locationReferenceMapper->mapOne($entity['location']),
            $entity['image'],
            $this->urlToIntTransformer->transformList($entity['episode']),
            $this->stringDateTimeTransformer->transform($entity['created']),
        );
    }
}
