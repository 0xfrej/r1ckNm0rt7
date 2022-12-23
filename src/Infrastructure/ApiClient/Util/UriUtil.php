<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Util;

use Psr\Http\Message\RequestInterface;

class UriUtil
{
    /**
     * Appends query parameters to existing query fragment
     *
     * @param array<string, string>              $queryParams
     */
    public static function appendQuery(RequestInterface $request, array $queryParams): RequestInterface
    {
        parse_str($request->getUri()->getQuery(), $result);
        $result = array_merge($result, $queryParams);

        return self::setQuery($request, $result);
    }

    /**
     * @param array                              $queryParams
     */
    public static function setQuery(RequestInterface $request, array $queryParams): RequestInterface
    {
        return $request->withUri(
            $request->getUri()->withQuery(http_build_query($queryParams))
        );
    }
}
