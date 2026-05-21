<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'order_items')]
class OrderItem extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'items')]
    #[ORM\JoinColumn(name: 'order_identifier', referencedColumnName: 'identifier', nullable: false)]
    private Order $order;

    #[ORM\ManyToOne(targetEntity: TicketType::class, inversedBy: 'orderItems')]
    #[ORM\JoinColumn(name: 'ticket_type_identifier', referencedColumnName: 'identifier', nullable: false)]
    private TicketType $ticketType;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $unitPrice;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $totalPrice;

    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'orderItem')]
    private Collection $tickets;

    public function __construct()
    {
        parent::__construct();
        $this->tickets = new ArrayCollection();
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    public function getTicketType(): TicketType
    {
        return $this->ticketType;
    }

    public function setTicketType(TicketType $ticketType): void
    {
        $this->ticketType = $ticketType;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getUnitPrice(): string
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(string $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getTotalPrice(): string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function setTickets(Collection $tickets): void
    {
        $this->tickets = $tickets;
    }
}

