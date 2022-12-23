<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Filter;

interface IFilterCollection
{
    /**
     * Gets filter value by key. Null on value not found
     */
    public function get(string $key): ?string;

    /**
     * Set filter value for the provided key
     */
    public function set(string $key, string $value): IFilterCollection;

    /**
     * Unsets filter value for the provided key
     */
    public function unset(string $key): IFilterCollection;

    /**
     * Returns array of filters
     *
     * @return array<string, string>
     */
    public function toArray(): array;
}
