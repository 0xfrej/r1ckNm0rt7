<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto;

use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class Episode
{
    #[Groups('default')]
    protected int $id;

    #[Groups('default')]
    protected string $name;

    #[Groups('detail')]
    protected DateTimeInterface $airDate;

    #[Groups('detail')]
    protected string $episode;

    /**
     * @var array<int>
     */
    #[Groups('detail')]
    protected array $characters;

    #[Groups('detail')]
    protected DateTimeInterface $created;

    /**
     * @param array<int>         $characters
     */
    public function __construct(
        int $id,
        string $name,
        DateTimeInterface $airDate,
        string $episode,
        array $characters,
        DateTimeInterface $created
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->airDate = $airDate;
        $this->episode = $episode;
        $this->characters = $characters;
        $this->created = $created;
    }

    /**
     * Get the id of the episode.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the name of the episode.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the air date of the episode.
     */
    public function getAirDate(): DateTimeInterface
    {
        return $this->airDate;
    }

    /**
     * Get the code of the episode.
     */
    public function getEpisodeCode(): string
    {
        return $this->episode;
    }

    /**
     * Get the list of characters who have been seen in the episode.
     *
     * @return array<int>
     */
    public function getCharacters(): array
    {
        return $this->characters;
    }

    /**
     * Get the time at which the episode was created in the database.
     */
    public function getCreated(): DateTimeInterface
    {
        return $this->created;
    }
}
