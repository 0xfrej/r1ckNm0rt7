<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Transformer;

use App\Infrastructure\ApiClient\DataTransformer\AbstractTransformer;
use App\Infrastructure\ApiClient\Exception\TransformationException;

/**
 * @extends AbstractTransformer<string|null, int|null, int>
 */
class UrlToPageNumberTransformer extends AbstractTransformer
{
    /**
     * @inheritdoc
     */
    public function transform(mixed $val): ?int
    {
        if (! is_string($val)) {
            throw new TransformationException(sprintf('Expected string, %s given', gettype($val)));
        }
        $parts = parse_url($val);
        if (is_array($parts)) {
            parse_str($parts['query'] ?? '', $query);
            return isset($query['page']) ? (int) $query['page'] : null;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function transformList(array $valList): array
    {
        /** @psalm-var array<int|null> $result */
        $result = parent::transformList($valList);
        return array_filter($result, static fn($val) => !is_null($val));
    }
}
