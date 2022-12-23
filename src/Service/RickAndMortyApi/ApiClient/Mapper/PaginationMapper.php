<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Mapper;

use App\Infrastructure\ApiClient\DataMapper\AbstractDataMapper;
use App\Service\RickAndMortyApi\ApiClient\Dto\Pagination;
use App\Service\RickAndMortyApi\ApiClient\Transformer\UrlToPageNumberTransformer;

/**
 * @extends AbstractDataMapper<Pagination, array<string, mixed>>
 */
class PaginationMapper extends AbstractDataMapper
{
    public function __construct(
        protected UrlToPageNumberTransformer $urlToPageTransformer
    ) {
    }

    /**
     * @inheritDoc
     */
    public function mapOne(array $entity): Pagination
    {
        return new Pagination(
            [
                'count' => $entity['count'],
                'pages' => $entity['pages'],
                'next' => isset($entity['next']) ? $this->urlToPageTransformer->transform($entity['next']) : null,
                'prev' => isset($entity['prev']) ? $this->urlToPageTransformer->transform($entity['prev']) : null,
            ]
        );
    }
}
