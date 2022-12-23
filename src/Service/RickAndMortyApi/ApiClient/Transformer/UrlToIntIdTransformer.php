<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Transformer;

use App\Infrastructure\ApiClient\DataTransformer\AbstractTransformer;
use App\Infrastructure\ApiClient\Exception\TransformationException;

/**
 * @extends AbstractTransformer<string, int>
 */
class UrlToIntIdTransformer extends AbstractTransformer
{
    protected const REGEX = "/([^\/]+$)/";

    /**
     * @inheritdoc
     */
    public function transform(string $val): ?int
    {
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
}
