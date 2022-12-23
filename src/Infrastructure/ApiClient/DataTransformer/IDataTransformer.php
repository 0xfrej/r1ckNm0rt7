<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\DataTransformer;

/**
 * Used to transform data from A to B
 *
 * @template A
 * @template B
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
    public function transform(string $val): void;

    /**
     * Transforms list of A to list of B
     *
     * @psalm-param array<A> $valList
     * @psalm-return array<B>
     * @throws \App\Infrastructure\ApiClient\Exception\TransformationException
     */
    public function transformList(array $valList): array;
}
