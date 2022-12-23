<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Filter;

class FilterCollection implements IFilterCollection
{
    /**
     * @param array<string, string> $collection
     */
    public function __construct(
        protected array $collection
    ) {
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->collection;
    }

    /**
     * @inheritDoc
     */
    public function get(string $key): ?string
    {
        return $this->collection[$key] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, string $value): IFilterCollection
    {
        $this->collection[$key] = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function unset(string $key): IFilterCollection
    {
        unset($this->collection[$key]);

        return $this;
    }

    /**
     * Create new instance of filter collection
     *
     * @param array $initialCollection
     * @return static
     */
    public static function make(array $initialCollection = []): self
    {
        return new self($initialCollection);
    }
}
