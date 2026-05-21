<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'audit_logs')]
class AuditLog extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'auditLogs')]
    #[ORM\JoinColumn(name: 'user_identifier', referencedColumnName: 'identifier', nullable: true)]
    private ?User $user = null;

    #[ORM\Column(length: 120)]
    private string $entity;

    #[ORM\Column(name: 'entity_identifier', type: 'uuid')]
    private Uuid $entityIdentifier;

    #[ORM\Column(length: 80)]
    private string $action;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $oldValues = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $newValues = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $ipAddress = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $userAgent = null;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    public function getEntity(): string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): void
    {
        $this->entity = $entity;
    }

    public function getEntityIdentifier(): Uuid
    {
        return $this->entityIdentifier;
    }

    public function setEntityIdentifier(Uuid $entityIdentifier): void
    {
        $this->entityIdentifier = $entityIdentifier;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getOldValues(): ?array
    {
        return $this->oldValues;
    }

    public function setOldValues(?array $oldValues): void
    {
        $this->oldValues = $oldValues;
    }

    public function getNewValues(): ?array
    {
        return $this->newValues;
    }

    public function setNewValues(?array $newValues): void
    {
        $this->newValues = $newValues;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(?string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(?string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }
}

