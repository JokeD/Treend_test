<?php


namespace App\Domain;


use App\Domain\Exception\InvalidPartnershipStatusChangeTypeException;

class Shipping
{

    const SHIPPING_PENDING_STATUS = 'SHIPPING_PENDING';
    const SHIPPING_SHIPPED_STATUS = 'SHIPPING_SHIPPED';
    const SHIPPING_RECEIVED_STATUS = 'SHIPPING_RECEIVED';

    const ALLOWED_STATUS = [
        self::SHIPPING_PENDING_STATUS,
        self::SHIPPING_RECEIVED_STATUS,
        self::SHIPPING_SHIPPED_STATUS
    ];

    private $id;
    private ?string $status;
    private ?\DateTime $shippedAt = null;


    private function __construct(?string $status = self::SHIPPING_PENDING_STATUS)
    {
        if (!in_array($status, self::ALLOWED_STATUS)) {
            throw InvalidPartnershipStatusChangeTypeException::msg(self::ALLOWED_STATUS, $status);
        }
        $this->status = $status;
    }

    public function id(): int
    {
        return $this->id;
    }

    public static function create(?string $status = self::SHIPPING_PENDING_STATUS): self
    {
        return new self($status);
    }

    public function shipped(): void
    {
        $this->status    = self::SHIPPING_SHIPPED_STATUS;
        $this->shippedAt = new \DateTime();
    }

    public function received(): void
    {
        $this->status = self::SHIPPING_RECEIVED_STATUS;

    }

    public function status(): string
    {
        return $this->status;
    }

    public function shippedAt(): \DateTime|null
    {
        return $this->shippedAt;
    }




}