<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case CANCELED = 'canceled';
    case EXPIRED = 'expired';
    case REFUNDED = 'refunded';
}
