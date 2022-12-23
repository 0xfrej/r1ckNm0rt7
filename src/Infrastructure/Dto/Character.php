<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto;

use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class Character
{
    #[Groups('default')]
    protected int $id;

    #[Groups('default')]
    protected string $name;

    #[Groups('detail')]
    protected string $status;

    #[Groups('detail')]
    protected string $species;

    #[Groups('detail')]
    protected string $type;

    #[Groups('detail')]
    protected string $gender;

    #[Groups('detail')]
    protected LocationReference $origin;

    #[Groups('detail')]
    protected LocationReference $location;

    #[Groups('detail')]
    protected string $avatarUrl;

    /**
     * @var array<int>
     */
    #[Groups('detail')]
    protected array $episodeList;

    #[Groups('detail')]
    protected DateTimeInterface $created;

    /**
     * @param array<int>                                $episodeList
     */
    public function __construct(
        int $id,
        string $name,
        string $status,
        string $species,
        string $type,
        string $gender,
        LocationReference $origin,
        LocationReference $location,
        string $avatarUrl,
        array $episodeList,
        DateTimeInterface $created
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->species = $species;
        $this->type = $type;
        $this->gender = $gender;
        $this->origin = $origin;
        $this->location = $location;
        $this->avatarUrl = $avatarUrl;
        $this->episodeList = $episodeList;
        $this->created = $created;
    }


    /**
     * Get the id of the character.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the name of the character.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the status of the character ('Alive', 'Dead' or 'unknown').
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Get the species of the character.
     */
    public function getSpecies(): string
    {
        return $this->species;
    }

    /**
     * Get the type or subspecies of the character.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the gender of the character ('Female', 'Male', 'Genderless' or 'unknown').
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * Get the LocationReference of character's origin.
     */
    public function getOrigin(): LocationReference
    {
        return $this->origin;
    }

    /**
     * Get the LocationReference of character's last known position
     */
    public function getLocation(): LocationReference
    {
        return $this->location;
    }

    /**
     * Get link to the character's image.
     *
     * All images are 300x300px and most are medium shots
     * or portraits since they are intended to be used as avatars.
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * Get the list of episodes in which this character appeared.
     *
     * @return array<int>
     */
    public function getEpisodeList(): array
    {
        return $this->episodeList;
    }

    /**
     * Get the time at which the character was created in the database.
     */
    public function getCreated(): DateTimeInterface
    {
        return $this->created;
    }
}
