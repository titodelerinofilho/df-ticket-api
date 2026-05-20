<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Correlation;

use App\Application\Service\Correlation\CorrelationServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Uid\Uuid;

final class CorrelationService implements CorrelationServiceInterface
{
    private string $correlationIdentifier;

    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
        $this->correlationIdentifier = Uuid::v4()->toRfc4122();
    }

    public function getCorrelationIdentifier(): string
    {
        $request = $this->requestStack->getCurrentRequest();

        if (false === $request instanceof Request) {
            return $this->correlationIdentifier;
        }

        $correlationIdentifier = trim((string) $request->headers->get('X-Correlation-ID', ''));

        if (true === empty($correlationIdentifier)) {
            return $this->correlationIdentifier;
        }

        return $correlationIdentifier;
    }

    public function setCorrelationIdentifier(string $correlationIdentifier): void
    {
        $this->correlationIdentifier = $correlationIdentifier;
    }
}
