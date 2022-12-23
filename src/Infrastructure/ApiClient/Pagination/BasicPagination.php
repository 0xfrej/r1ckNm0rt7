<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Pagination;

class BasicPagination implements IPagination
{
    public function __construct(
        protected int $totalPages,
        protected int $totalEntities,
        protected int $currentPage
    ) {
    }


    /**
     * @inheritDoc
     */
    public function hasNext(): bool
    {
        return $this->currentPage < $this->totalPages;
    }

    /**
     * @inheritDoc
     */
    public function hasPrev(): bool
    {
        return $this->currentPage > 1;
    }

    /**
     * @inheritDoc
     */
    public function next(): ?int
    {
        if ($this->hasNext()) {
            return $this->currentPage + 1;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function previous(): ?int
    {
        if ($this->hasPrev()) {
            return $this->currentPage - 1;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function current(): int
    {
        return $this->currentPage;
    }

    /**
     * @inheritDoc
     */
    public function totalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @inheritDoc
     */
    public function totalEntities(): int
    {
        return $this->totalEntities;
    }
}
