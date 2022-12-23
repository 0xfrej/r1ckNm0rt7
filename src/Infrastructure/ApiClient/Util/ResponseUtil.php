<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Util;

use Psr\Http\Message\ResponseInterface;

class ResponseUtil
{
    public static function isErrorStatus(ResponseInterface $response): bool
    {
        return $response->getStatusCode() > 399;
    }
}
