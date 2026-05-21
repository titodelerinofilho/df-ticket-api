<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\CouponType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(
    name: 'coupons',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_coupons_code', columns: ['code']),
    ],
)]
class Coupon extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'coupons')]
    #[ORM\JoinColumn(name: 'event_identifier', referencedColumnName: 'identifier', nullable: true)]
    private ?Event $event = null;

    #[ORM\Column(length: 80)]
    private string $code;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(enumType: CouponType::class)]
    private CouponType $type;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $value;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $maxUses = null;

    #[ORM\Column(type: 'integer')]
    private int $usedCount = 0;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $startsAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $endsAt = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = true;

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): void
    {
        $this->event = $event;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getType(): CouponType
    {
        return $this->type;
    }

    public function setType(CouponType $type): void
    {
        $this->type = $type;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getMaxUses(): ?int
    {
        return $this->maxUses;
    }

    public function setMaxUses(?int $maxUses): void
    {
        $this->maxUses = $maxUses;
    }

    public function getUsedCount(): int
    {
        return $this->usedCount;
    }

    public function setUsedCount(int $usedCount): void
    {
        $this->usedCount = $usedCount;
    }

    public function getStartsAt(): ?\DateTime
    {
        return $this->startsAt;
    }

    public function setStartsAt(?\DateTime $startsAt): void
    {
        $this->startsAt = $startsAt;
    }

    public function getEndsAt(): ?\DateTime
    {
        return $this->endsAt;
    }

    public function setEndsAt(?\DateTime $endsAt): void
    {
        $this->endsAt = $endsAt;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}

