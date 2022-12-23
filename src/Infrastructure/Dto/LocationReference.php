<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

class LocationReference
{
    #[Groups('default')]
    protected ?int $id;

    #[Groups('default')]
    protected string $name;

    public function __construct(?int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Get the name of the location
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the id of the location
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
