<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\DataTransformer;

/**
 * Used to transform data from A to B
 *
 * @template A of mixed
 * @template B of mixed
 * @template C of mixed
 */
interface IDataTransformer
{
    /**
     * Transforms A to B
     *
     * @psalm-param A $val
     * @psalm-return B
     * @throws \App\Infrastructure\ApiClient\Exception\TransformationException
     */
    public function transform(mixed $val): mixed;

    /**
     * Transforms list of A to list of B
     *
     * @psalm-param array<A> $valList
     * @psalm-return array<C>
     * @throws \App\Infrastructure\ApiClient\Exception\TransformationException
     */
    public function transformList(array $valList): array;
}
