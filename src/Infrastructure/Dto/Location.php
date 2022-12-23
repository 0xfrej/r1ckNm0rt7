<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto;

use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class Location
{
    #[Groups('default')]
    protected int $id;

    #[Groups('default')]
    protected string $name;

    #[Groups('detail')]
    protected string $type;

    #[Groups('detail')]
    protected string $dimension;

    /**
     * @var array<int>
     */
    #[Groups('detail')]
    protected array $residents;

    #[Groups('detail')]
    protected DateTimeInterface $created;

    public function __construct(
        int $id,
        string $name,
        string $type,
        string $dimension,
        array $residents,
        DateTimeInterface $created
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->dimension = $dimension;
        $this->residents = $residents;
        $this->created = $created;
    }

    /**
     * Get the id of the location.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the name of the location.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the type of the location.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the dimension in which the location is located.
     */
    public function getDimension(): string
    {
        return $this->dimension;
    }

    /**
     * Get the list of character who have been last seen in the location.
     *
     * @return array
     */
    public function getResidents(): array
    {
        return $this->residents;
    }

    /**
     * Get the time at which the location was created in the database.
     */
    public function getCreated(): DateTimeInterface
    {
        return $this->created;
    }
}
