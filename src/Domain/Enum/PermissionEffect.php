<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum PermissionEffect: string
{
    case GRANTED = 'granted';
    case DENIED = 'denied';
}
