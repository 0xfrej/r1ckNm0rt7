<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Response;

interface IResponse
{
    /**
     * Indicates whether response was a failure
     */
    public function isError(): bool;

    /**
     * Returns response http code
     */
    public function getHttpCode(): int;
}
