<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\DataMapper;

/**
 * Used to map data from array to an DTO class object
 *
 * @template T of object
 * @template A of array
 * @implements IDataMapper<T, A>
 */
abstract class AbstractDataMapper implements IDataMapper
{
    /**
     * @inheritdoc
     */
    public function mapMany(array $entities): array
    {
        return array_map(fn($entity) => $this->mapOne($entity), $entities);
    }
}
