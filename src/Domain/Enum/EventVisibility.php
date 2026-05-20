<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum EventVisibility: string
{
    case PUBLIC = 'public';
    case PRIVATE = 'private';
    case UNLISTED = 'unlisted';
}
