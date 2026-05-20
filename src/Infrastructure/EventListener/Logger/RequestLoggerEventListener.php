<?php

declare(strict_types=1);

namespace App\Infrastructure\EventListener\Logger;

use App\Infrastructure\Service\Correlation\CorrelationService;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;

#[AsEventListener(event: RequestEvent::class, priority: 100)]
final readonly class RequestLoggerEventListener
{
    public function __construct(
        private LoggerInterface $requestsLogger,
        private ParameterBagInterface $params,
        private CorrelationService $correlationService,
    ) {
    }

    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();

        $loggerActivated = $this->params->get('app.log.requests');

        if (true !== $loggerActivated) {
            return;
        }

        $this->requestsLogger->info(
            message: $this->correlationService->getCorrelationIdentifier(),
            context: [
                'method' => $request->getMethod(),
                'uri' => $request->getUri(),
                'headers' => $request->headers->all(),
                'requestBody' => $request->getContent(),
            ],
        );
    }
}
