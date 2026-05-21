<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'check_ins')]
class CheckIn extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: Ticket::class, inversedBy: 'checkIns')]
    #[ORM\JoinColumn(name: 'ticket_identifier', referencedColumnName: 'identifier', nullable: false)]
    private Ticket $ticket;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'checkIns')]
    #[ORM\JoinColumn(name: 'checked_by_identifier', referencedColumnName: 'identifier', nullable: true)]
    private ?User $checkedBy = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $checkedAt;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $deviceInfo = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $ipAddress = null;

    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    public function setTicket(Ticket $ticket): void
    {
        $this->ticket = $ticket;
    }

    public function getCheckedBy(): ?User
    {
        return $this->checkedBy;
    }

    public function setCheckedBy(?User $checkedBy): void
    {
        $this->checkedBy = $checkedBy;
    }

    public function getCheckedAt(): \DateTime
    {
        return $this->checkedAt;
    }

    public function setCheckedAt(\DateTime $checkedAt): void
    {
        $this->checkedAt = $checkedAt;
    }

    public function getDeviceInfo(): ?string
    {
        return $this->deviceInfo;
    }

    public function setDeviceInfo(?string $deviceInfo): void
    {
        $this->deviceInfo = $deviceInfo;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(?string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }
}

