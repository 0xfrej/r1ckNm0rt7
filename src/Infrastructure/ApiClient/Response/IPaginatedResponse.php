<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Response;

use App\Infrastructure\ApiClient\Pagination\IPagination;

interface IPaginatedResponse
{
    /**
     * Gets pagination data from response
     */
    public function getPagination(): IPagination;
}
