<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\DataMapper;

/**
 * Used to map data from array to an DTO class object
 *
 * @template T of object
 * @template A of array
 */
interface IDataMapper
{
    /**
     * Map data to one
     *
     * @psalm-param A $entity
     * @psalm-return T
     * @throws \App\Infrastructure\ApiClient\Exception\MappingException
     * @throws \App\Infrastructure\ApiClient\Exception\TransformationException may be thrown in transformer the mapper is using
     */
    public function mapOne(array $entity): object;

    /**
     * Map data to many
     *
     * @psalm-param A $entities
     * @psalm-return array<T>
     * @throws \App\Infrastructure\ApiClient\Exception\MappingException
     * @throws \App\Infrastructure\ApiClient\Exception\TransformationException may be thrown in transformer the mapper is using
     */
    public function mapMany(array $entities): array;
}
