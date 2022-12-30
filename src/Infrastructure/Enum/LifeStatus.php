<?php

declare(strict_types=1);

namespace App\Infrastructure\Enum;

enum LifeStatus : string
{
    case Alive = 'Alive';
    case Dead = 'Dead';
    case Unknown = 'unknown';
}
