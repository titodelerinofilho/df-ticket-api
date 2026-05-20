<?php

declare(strict_types=1);

namespace App\Infrastructure\EventListener\Logger;

use App\Infrastructure\Service\Correlation\CorrelationService;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

#[AsEventListener(event: ResponseEvent::class, priority: 100)]
final readonly class ResponseLoggerEventListener
{
    public function __construct(
        private LoggerInterface $responsesLogger,
        private CorrelationService $correlationService,
        private ParameterBagInterface $params,
    ) {
    }

    public function __invoke(ResponseEvent $event): void
    {
        $response = $event->getResponse();

        $loggerActivated = $this->params->get('app.log.responses');

        if (true !== $loggerActivated) {
            return;
        }

        $this->responsesLogger->info(
            message: $this->correlationService->getCorrelationIdentifier(),
            context: [
                'headers' => $response->headers->all(),
                'statusCode' => $response->getStatusCode(),
                'responseBody' => $response->getContent(),
            ],
        );
    }
}
