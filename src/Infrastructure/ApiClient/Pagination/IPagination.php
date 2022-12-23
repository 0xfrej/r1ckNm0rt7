<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Pagination;

interface IPagination
{
    /**
     * Returns whether pagination has next page available.
     */
    public function hasNext(): bool;

    /**
     * Returns whether pagination has previous page available.
     */
    public function hasPrev(): bool;

    /**
     * Gets next page number.
     *
     * @return ?int next page number or null if there is no next page available.
     */
    public function next(): ?int;

    /**
     * Gets next page number.
     *
     * @return ?int previous page number or null if there is no previous page available.
     */
    public function previous(): ?int;

    /**
     * Gets current page number.
     */
    public function current(): int;

    /**
     * Gets total number of pages available.
     */
    public function totalPages(): int;

    /**
     * Gets total number of entities available.
     */
    public function totalEntities(): int;
}
