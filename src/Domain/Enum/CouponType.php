<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum CouponType: string
{
    case PERCENTAGE = 'percentage';
    case FIXED = 'fixed';
}

