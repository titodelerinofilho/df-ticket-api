<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\EventStatus;
use App\Domain\Enum\EventVisibility;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'events')]
#[ORM\HasLifecycleCallbacks]
class Event
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $identifier;

    #[ORM\Column(type: 'uuid')]
    private Uuid $organizerIdentifier;

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
    private DateTime $startAt;

    #[ORM\Column(type: 'datetime')]
    private DateTime $endAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $salesStartAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $salesEndAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $publishedAt = null;

    #[ORM\Column(enumType: EventStatus::class)]
    private EventStatus $status = EventStatus::DRAFT;

    #[ORM\Column(enumType: EventVisibility::class)]
    private EventVisibility $visibility = EventVisibility::PUBLIC;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $maxTickets = null;

    #[ORM\Column(type: 'uuid', nullable: true)]
    private ?Uuid $createdBy = null;

    #[ORM\Column(type: 'uuid', nullable: true)]
    private ?Uuid $updatedBy = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $deletedAt = null;

    public function __construct()
    {
        $this->identifier = Uuid::v7();
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $now = new DateTimeImmutable();
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getIdentifier(): Uuid
    {
        return $this->identifier;
    }

    public function setIdentifier(Uuid $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getOrganizerIdentifier(): Uuid
    {
        return $this->organizerIdentifier;
    }

    public function setOrganizerIdentifier(Uuid $organizerIdentifier): void
    {
        $this->organizerIdentifier = $organizerIdentifier;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function setBanner(?string $banner): void
    {
        $this->banner = $banner;
    }

    public function getLocationName(): string
    {
        return $this->locationName;
    }

    public function setLocationName(string $locationName): void
    {
        $this->locationName = $locationName;
    }

    public function getLocationAddress(): string
    {
        return $this->locationAddress;
    }

    public function setLocationAddress(string $locationAddress): void
    {
        $this->locationAddress = $locationAddress;
    }

    public function getLocationCity(): string
    {
        return $this->locationCity;
    }

    public function setLocationCity(string $locationCity): void
    {
        $this->locationCity = $locationCity;
    }

    public function getLocationState(): string
    {
        return $this->locationState;
    }

    public function setLocationState(string $locationState): void
    {
        $this->locationState = $locationState;
    }

    public function getLocationZipcode(): ?string
    {
        return $this->locationZipcode;
    }

    public function setLocationZipcode(?string $locationZipcode): void
    {
        $this->locationZipcode = $locationZipcode;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getStartAt(): DateTime
    {
        return $this->startAt;
    }

    public function setStartAt(DateTime $startAt): void
    {
        $this->startAt = $startAt;
    }

    public function getEndAt(): DateTime
    {
        return $this->endAt;
    }

    public function setEndAt(DateTime $endAt): void
    {
        $this->endAt = $endAt;
    }

    public function getSalesStartAt(): ?DateTime
    {
        return $this->salesStartAt;
    }

    public function setSalesStartAt(?DateTime $salesStartAt): void
    {
        $this->salesStartAt = $salesStartAt;
    }

    public function getSalesEndAt(): ?DateTime
    {
        return $this->salesEndAt;
    }

    public function setSalesEndAt(?DateTime $salesEndAt): void
    {
        $this->salesEndAt = $salesEndAt;
    }

    public function getPublishedAt(): ?DateTime
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?DateTime $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    public function getStatus(): EventStatus
    {
        return $this->status;
    }

    public function setStatus(EventStatus $status): void
    {
        $this->status = $status;
    }

    public function getVisibility(): EventVisibility
    {
        return $this->visibility;
    }

    public function setVisibility(EventVisibility $visibility): void
    {
        $this->visibility = $visibility;
    }

    public function getMaxTickets(): ?int
    {
        return $this->maxTickets;
    }

    public function setMaxTickets(?int $maxTickets): void
    {
        $this->maxTickets = $maxTickets;
    }

    public function getCreatedBy(): ?Uuid
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Uuid $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getUpdatedBy(): ?Uuid
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?Uuid $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeImmutable $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}

