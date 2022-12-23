<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Dto;

use App\Infrastructure\ApiClient\Pagination\BasicPagination;

class Pagination extends BasicPagination
{
    /**
     * @param array{
     *     count: int,
     *     pages: int,
     *     next: int|null,
     *     prev: int|null,
     * } $paginationData
     */
    public function __construct(
        array $paginationData
    ) {
        parent::__construct(
            $paginationData['pages'],
            $paginationData['count'],
            $paginationData['next'] === null ? $paginationData['prev'] + 1 : $paginationData['next'] + 1
        );
    }
}
