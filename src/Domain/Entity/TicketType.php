<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\TicketTypeStatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'ticket_types')]
class TicketType extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'ticketTypes')]
    #[ORM\JoinColumn(name: 'event_identifier', referencedColumnName: 'identifier', nullable: false)]
    private Event $event;

    #[ORM\Column(length: 120)]
    private string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $price;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $maxPerOrder = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $salesStartAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $salesEndAt = null;

    #[ORM\Column(enumType: TicketTypeStatus::class)]
    private TicketTypeStatus $status = TicketTypeStatus::DRAFT;

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getMaxPerOrder(): ?int
    {
        return $this->maxPerOrder;
    }

    public function setMaxPerOrder(?int $maxPerOrder): void
    {
        $this->maxPerOrder = $maxPerOrder;
    }

    public function getSalesStartAt(): ?\DateTime
    {
        return $this->salesStartAt;
    }

    public function setSalesStartAt(?\DateTime $salesStartAt): void
    {
        $this->salesStartAt = $salesStartAt;
    }

    public function getSalesEndAt(): ?\DateTime
    {
        return $this->salesEndAt;
    }

    public function setSalesEndAt(?\DateTime $salesEndAt): void
    {
        $this->salesEndAt = $salesEndAt;
    }

    public function getStatus(): TicketTypeStatus
    {
        return $this->status;
    }

    public function setStatus(TicketTypeStatus $status): void
    {
        $this->status = $status;
    }
}
