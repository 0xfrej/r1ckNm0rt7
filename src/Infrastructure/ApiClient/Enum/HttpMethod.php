<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Enum;

class HttpMethod
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const HEAD = 'HEAD';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';
    public const OPTIONS = 'OPTIONS';
    public const PATCH = 'PATCH';
}
