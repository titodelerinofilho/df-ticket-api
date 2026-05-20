<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum EventStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case CANCELLED = 'cancelled';
    case FINISHED = 'finished';
}
