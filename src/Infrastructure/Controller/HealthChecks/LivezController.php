<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\HealthChecks;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class LivezController
{
    #[Route(path: '/livez', name: 'healthcheck_livez', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'alive']);
    }
}

