<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum TicketStatus: string
{
    case PENDING = 'pending';
    case VALID = 'valid';
    case USED = 'used';
    case CANCELED = 'canceled';
    case REFUNDED = 'refunded';
}

