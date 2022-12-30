<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Mapper;

use App\Infrastructure\ApiClient\DataMapper\AbstractDataMapper;
use App\Infrastructure\ApiClient\DataTransformer\StringDateTimeTransformer;
use App\Infrastructure\Dto\Character;
use App\Infrastructure\Enum\Gender;
use App\Infrastructure\Enum\LifeStatus;
use App\Service\RickAndMortyApi\ApiClient\Transformer\UrlToIntIdTransformer;

/**
 * @extends AbstractDataMapper<Character, array<string, mixed>>
 */
class CharacterMapper extends AbstractDataMapper
{
    public function __construct(
        protected LocationReferenceMapper $locationRefMapper,
        protected UrlToIntIdTransformer $urlToIntTransformer,
        protected StringDateTimeTransformer $strDateTransformer
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
            LifeStatus::from($entity['status']),
            $entity['species'],
            $entity['type'],
            Gender::from($entity['gender']),
            $this->locationRefMapper->mapOne($entity['origin']),
            $this->locationRefMapper->mapOne($entity['location']),
            $entity['image'],
            $this->urlToIntTransformer->transformList($entity['episode']),
            $this->strDateTransformer->transform($entity['created']),
        );
    }
}
