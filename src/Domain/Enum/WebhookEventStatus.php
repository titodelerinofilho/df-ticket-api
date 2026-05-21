<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum WebhookEventStatus: string
{
    case PENDING = 'pending';
    case PROCESSED = 'processed';
    case FAILED = 'failed';
}

