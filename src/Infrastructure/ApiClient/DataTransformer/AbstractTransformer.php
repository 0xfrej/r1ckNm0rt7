<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\DataTransformer;

/**
 * Used to transform data from A to B
 *
 * @template A
 * @template B
 * @extends IDataTransformer<A, B>
 */
abstract class AbstractTransformer implements IDataTransformer
{
    /**
     * @inheritdoc
     */
    public function transformList(array $valList): array
    {
        return array_map(fn($val) => $this->transform($val), $valList);
    }
}
