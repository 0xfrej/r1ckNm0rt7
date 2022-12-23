<?php

declare(strict_types=1);

namespace App\Dto\Api;

class ApiPagination
{
    protected ?int $nextPage = null;
    protected ?int $previousPage = null;

    public function __construct(
        protected int $totalPages,
        protected int $totalEntities,
        protected int $currentPage
    ) {
        if ($this->currentPage < $this->totalPages) {
            $this->nextPage = $this->currentPage + 1;
        }

        if ($this->currentPage > $this->totalPages) {
            $this->nextPage = $this->currentPage - 1;
        }
    }
}
