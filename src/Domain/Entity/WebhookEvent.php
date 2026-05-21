<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\WebhookEventStatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'webhook_events')]
class WebhookEvent extends AbstractEntity
{
    #[ORM\Column(length: 120)]
    private string $type;

    #[ORM\Column(type: 'json')]
    private array $payload;

    #[ORM\Column(enumType: WebhookEventStatus::class)]
    private WebhookEventStatus $status = WebhookEventStatus::PENDING;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $processedAt = null;

    #[ORM\Column(type: 'integer')]
    private int $retries = 0;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }

    public function getStatus(): WebhookEventStatus
    {
        return $this->status;
    }

    public function setStatus(WebhookEventStatus $status): void
    {
        $this->status = $status;
    }

    public function getProcessedAt(): ?\DateTime
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?\DateTime $processedAt): void
    {
        $this->processedAt = $processedAt;
    }

    public function getRetries(): int
    {
        return $this->retries;
    }

    public function setRetries(int $retries): void
    {
        $this->retries = $retries;
    }
}

