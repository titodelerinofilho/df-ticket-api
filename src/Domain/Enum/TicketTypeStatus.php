<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum TicketTypeStatus: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case SOLD_OUT = 'sold_out';
    case INACTIVE = 'inactive';
}
