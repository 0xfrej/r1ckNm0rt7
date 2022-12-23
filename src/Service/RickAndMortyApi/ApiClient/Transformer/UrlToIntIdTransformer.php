<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Transformer;

use App\Infrastructure\ApiClient\DataTransformer\AbstractTransformer;
use App\Infrastructure\ApiClient\Exception\TransformationException;

/**
 * @extends AbstractTransformer<string, int|null, int>
 */
class UrlToIntIdTransformer extends AbstractTransformer
{
    protected const REGEX = "/([^\/]+$)/";

    /**
     * @inheritdoc
     */
    public function transform(mixed $val): ?int
    {
        if (! is_string($val)) {
            throw new TransformationException(sprintf('Expected string, %s given', gettype($val)));
        }
        if (empty($val)) {
            return null;
        }

        $matches = [];
        if (preg_match(self::REGEX, $val, $matches)) {
            return (int) $matches[0];
        }

        throw new TransformationException(
            sprintf(
                "Could not match id in given url '%s'",
                $val
            )
        );
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
