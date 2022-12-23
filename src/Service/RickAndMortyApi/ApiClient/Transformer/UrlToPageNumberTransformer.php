<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Transformer;

use App\Infrastructure\ApiClient\DataTransformer\AbstractTransformer;

/**
 * @extends AbstractTransformer<string|null, int|null>
 */
class UrlToPageNumberTransformer extends AbstractTransformer
{
    /**
     * @inheritdoc
     */
    public function transform(string $val): ?int
    {
        $parts = parse_url($val);
        if (is_array($parts)) {
            parse_str($parts['query'], $query);
            return isset($query['page']) ? (int) $query['page'] : null;
        }

        return null;
    }
}
