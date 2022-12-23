<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient\Exception;

use App\Infrastructure\Exception\NotFoundException;

class LocationNotFoundException extends NotFoundException
{
}
