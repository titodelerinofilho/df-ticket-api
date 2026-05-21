<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\TicketStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(
    name: 'tickets',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_tickets_code', columns: ['code']),
    ],
)]
class Ticket extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(name: 'order_identifier', referencedColumnName: 'identifier', nullable: false)]
    private Order $order;

    #[ORM\ManyToOne(targetEntity: OrderItem::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(name: 'order_item_identifier', referencedColumnName: 'identifier', nullable: false)]
    private OrderItem $orderItem;

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(name: 'event_identifier', referencedColumnName: 'identifier', nullable: false)]
    private Event $event;

    #[ORM\ManyToOne(targetEntity: TicketType::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(name: 'ticket_type_identifier', referencedColumnName: 'identifier', nullable: false)]
    private TicketType $ticketType;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(name: 'user_identifier', referencedColumnName: 'identifier', nullable: false)]
    private User $user;

    #[ORM\Column(length: 120)]
    private string $code;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $qrcode = null;

    #[ORM\Column(enumType: TicketStatus::class)]
    private TicketStatus $status = TicketStatus::PENDING;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $issuedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $usedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $canceledAt = null;

    #[ORM\OneToMany(targetEntity: CheckIn::class, mappedBy: 'ticket')]
    private Collection $checkIns;

    public function __construct()
    {
        parent::__construct();
        $this->checkIns = new ArrayCollection();
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    public function getOrderItem(): OrderItem
    {
        return $this->orderItem;
    }

    public function setOrderItem(OrderItem $orderItem): void
    {
        $this->orderItem = $orderItem;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    public function getTicketType(): TicketType
    {
        return $this->ticketType;
    }

    public function setTicketType(TicketType $ticketType): void
    {
        $this->ticketType = $ticketType;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getQrcode(): ?string
    {
        return $this->qrcode;
    }

    public function setQrcode(?string $qrcode): void
    {
        $this->qrcode = $qrcode;
    }

    public function getStatus(): TicketStatus
    {
        return $this->status;
    }

    public function setStatus(TicketStatus $status): void
    {
        $this->status = $status;
    }

    public function getIssuedAt(): ?\DateTime
    {
        return $this->issuedAt;
    }

    public function setIssuedAt(?\DateTime $issuedAt): void
    {
        $this->issuedAt = $issuedAt;
    }

    public function getUsedAt(): ?\DateTime
    {
        return $this->usedAt;
    }

    public function setUsedAt(?\DateTime $usedAt): void
    {
        $this->usedAt = $usedAt;
    }

    public function getCanceledAt(): ?\DateTime
    {
        return $this->canceledAt;
    }

    public function setCanceledAt(?\DateTime $canceledAt): void
    {
        $this->canceledAt = $canceledAt;
    }

    public function getCheckIns(): Collection
    {
        return $this->checkIns;
    }

    public function setCheckIns(Collection $checkIns): void
    {
        $this->checkIns = $checkIns;
    }
}

