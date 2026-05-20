<?php

declare(strict_types=1);

namespace App\Application\Service\Correlation;

interface CorrelationServiceInterface
{
    public function getCorrelationIdentifier(): string;
}

