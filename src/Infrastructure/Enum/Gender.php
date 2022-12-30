<?php

declare(strict_types=1);

namespace App\Infrastructure\Enum;

enum Gender : string
{
    case Female = 'Female';
    case Male = 'Male';
    case Genderless = 'Genderless';
    case Unknown = 'unknown';
}
