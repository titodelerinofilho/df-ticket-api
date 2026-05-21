<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\EventStatus;
use App\Domain\Enum\EventVisibility;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'events')]
class Event extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: Organizer::class, inversedBy: 'events')]
    #[ORM\JoinColumn(name: 'organizer_identifier', referencedColumnName: 'identifier', nullable: false)]
    private Organizer $organizer;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(length: 255, unique: true)]
    private string $slug;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 2048, nullable: true)]
    private ?string $banner = null;

    #[ORM\Column(length: 255)]
    private string $locationName;

    #[ORM\Column(length: 255)]
    private string $locationAddress;

    #[ORM\Column(length: 120)]
    private string $locationCity;

    #[ORM\Column(length: 80)]
    private string $locationState;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $locationZipcode = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $latitude = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $longitude = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $startAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $endAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $salesStartAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $salesEndAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $publishedAt = null;

    #[ORM\Column(enumType: EventStatus::class)]
    private EventStatus $status = EventStatus::DRAFT;

    #[ORM\Column(enumType: EventVisibility::class)]
    private EventVisibility $visibility = EventVisibility::PUBLIC;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $maxTickets = null;

    #[ORM\Column(name: 'created_by_identifier', type: 'uuid', nullable: true)]
    private ?Uuid $createdByIdentifier = null;

    #[ORM\Column(name: 'updated_by_identifier', type: 'uuid', nullable: true)]
    private ?Uuid $updatedByIdentifier = null;

    #[ORM\OneToMany(targetEntity: TicketType::class, mappedBy: 'event')]
    private Collection $ticketTypes;

    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'event')]
    private Collection $orders;

    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'event')]
    private Collection $tickets;

    #[ORM\OneToMany(targetEntity: Coupon::class, mappedBy: 'event')]
    private Collection $coupons;

    public function __construct()
    {
        parent::__construct();
        $this->ticketTypes = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->tickets = new ArrayCollection();
        $this->coupons = new ArrayCollection();
    }

    public function getOrganizer(): Organizer { return $this->organizer; }
    public function setOrganizer(Organizer $organizer): void { $this->organizer = $organizer; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }
    public function getSlug(): string { return $this->slug; }
    public function setSlug(string $slug): void { $this->slug = $slug; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): void { $this->description = $description; }
    public function getBanner(): ?string { return $this->banner; }
    public function setBanner(?string $banner): void { $this->banner = $banner; }
    public function getLocationName(): string { return $this->locationName; }
    public function setLocationName(string $locationName): void { $this->locationName = $locationName; }
    public function getLocationAddress(): string { return $this->locationAddress; }
    public function setLocationAddress(string $locationAddress): void { $this->locationAddress = $locationAddress; }
    public function getLocationCity(): string { return $this->locationCity; }
    public function setLocationCity(string $locationCity): void { $this->locationCity = $locationCity; }
    public function getLocationState(): string { return $this->locationState; }
    public function setLocationState(string $locationState): void { $this->locationState = $locationState; }
    public function getLocationZipcode(): ?string { return $this->locationZipcode; }
    public function setLocationZipcode(?string $locationZipcode): void { $this->locationZipcode = $locationZipcode; }
    public function getLatitude(): ?float { return $this->latitude; }
    public function setLatitude(?float $latitude): void { $this->latitude = $latitude; }
    public function getLongitude(): ?float { return $this->longitude; }
    public function setLongitude(?float $longitude): void { $this->longitude = $longitude; }
    public function getStartAt(): \DateTime { return $this->startAt; }
    public function setStartAt(\DateTime $startAt): void { $this->startAt = $startAt; }
    public function getEndAt(): \DateTime { return $this->endAt; }
    public function setEndAt(\DateTime $endAt): void { $this->endAt = $endAt; }
    public function getSalesStartAt(): ?\DateTime { return $this->salesStartAt; }
    public function setSalesStartAt(?\DateTime $salesStartAt): void { $this->salesStartAt = $salesStartAt; }
    public function getSalesEndAt(): ?\DateTime { return $this->salesEndAt; }
    public function setSalesEndAt(?\DateTime $salesEndAt): void { $this->salesEndAt = $salesEndAt; }
    public function getPublishedAt(): ?\DateTime { return $this->publishedAt; }
    public function setPublishedAt(?\DateTime $publishedAt): void { $this->publishedAt = $publishedAt; }
    public function getStatus(): EventStatus { return $this->status; }
    public function setStatus(EventStatus $status): void { $this->status = $status; }
    public function getVisibility(): EventVisibility { return $this->visibility; }
    public function setVisibility(EventVisibility $visibility): void { $this->visibility = $visibility; }
    public function getMaxTickets(): ?int { return $this->maxTickets; }
    public function setMaxTickets(?int $maxTickets): void { $this->maxTickets = $maxTickets; }
    public function getCreatedByIdentifier(): ?Uuid { return $this->createdByIdentifier; }
    public function setCreatedByIdentifier(?Uuid $createdByIdentifier): void { $this->createdByIdentifier = $createdByIdentifier; }
    public function getUpdatedByIdentifier(): ?Uuid { return $this->updatedByIdentifier; }
    public function setUpdatedByIdentifier(?Uuid $updatedByIdentifier): void { $this->updatedByIdentifier = $updatedByIdentifier; }
    public function getTicketTypes(): Collection { return $this->ticketTypes; }
    public function setTicketTypes(Collection $ticketTypes): void { $this->ticketTypes = $ticketTypes; }
    public function getOrders(): Collection { return $this->orders; }
    public function setOrders(Collection $orders): void { $this->orders = $orders; }
    public function getTickets(): Collection { return $this->tickets; }
    public function setTickets(Collection $tickets): void { $this->tickets = $tickets; }
    public function getCoupons(): Collection { return $this->coupons; }
    public function setCoupons(Collection $coupons): void { $this->coupons = $coupons; }
}

