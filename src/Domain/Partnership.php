<?php

namespace App\Domain;


use App\Domain\Exception\InvalidStatusTypeException;
use App\Domain\Exception\InvalidPartnershipStatusChangeTypeException;


class Partnership
{
    const STATUS_NEW = 'NEW';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_ACCEPTED = 'ACCEPTED';
    const STATUS_FINISHED = 'FINISHED';
    const STATUS_CANCELLED = 'CANCELLED';

    const ALLOWED_STATUS = [
        self::STATUS_ACCEPTED,
        self::STATUS_REJECTED,
        self::STATUS_CANCELLED,
        self::STATUS_FINISHED,
    ];

    private int $id;

    private string $status;
    private ?string $comment;

    private Shipping $shipping;
    private Product $product;
    private Influencer $influencer;

    private ?\DateTime $handledDate;


    public function __construct(
        Influencer $influencer,
        Product $product,
        Shipping $shipping,
        string $comment,
        string $status = self::STATUS_NEW
    )
    {
        $this->shipping   = $shipping;
        $this->comment    = $comment;
        $this->status     = $status;
        $this->influencer = $influencer;
        $this->product    = $product;
    }

    public function id(): int|null
    {
        return $this->id;
    }

    public function comment(): string
    {
        return $this->comment;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function accepted(): void
    {
        $this->validateWhenIsInitialStatus(self::STATUS_ACCEPTED);
        $this->addHandledDate();
        $this->status = self::STATUS_ACCEPTED;
    }

    public function rejected(): void
    {
        $this->validateWhenIsInitialStatus(self::STATUS_REJECTED);
        $this->addHandledDate();
        $this->status = self::STATUS_REJECTED;
    }

    public function finished(): void
    {
        $this->validateWhenIsHandledStatus(self::STATUS_FINISHED);
        $this->addHandledDate();
        $this->status = self::STATUS_FINISHED;
    }

    public function cancelled(): void
    {
        $this->validateWhenIsHandledStatus(self::STATUS_CANCELLED);
        $this->addHandledDate();
        $this->status = self::STATUS_CANCELLED;
    }

    public function shipped(): void
    {
        $this->shipping->shipped();
    }

    public function received(): void
    {
        $this->shipping->received();
    }

    public function shippingStatus(): string
    {
        return $this->shipping->status();
    }

    public function shippedAt(): \DateTime|null
    {
        return $this->shipping->shippedAt();
    }

    public function influencer(): Influencer
    {
        return $this->influencer;
    }

    public function brand(): Brand
    {
        return $this->product->brand();
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function shipping(): Shipping
    {
        return $this->shipping;
    }

    private function validateWhenIsInitialStatus($requestedStatus): void
    {
        $this->validateIfIsAnExistingStatus($requestedStatus);

        if ($this->status !== self::STATUS_NEW) {
            throw InvalidPartnershipStatusChangeTypeException::msg(
                $this->status,
                $requestedStatus,
            );
        }
    }

    private function validateWhenIsHandledStatus($requestedStatus): void
    {
        $this->validateIfIsAnExistingStatus($requestedStatus);

        if ($this->status === self::STATUS_REJECTED || $this->status === self::STATUS_ACCEPTED) {
            return;
        }
        throw InvalidPartnershipStatusChangeTypeException::msg(
            $this->status,
            $requestedStatus,
        );
    }

    private function validateIfIsAnExistingStatus($requestedStatus): void
    {
        if (!in_array(strtoupper($requestedStatus), self::ALLOWED_STATUS)) {
            throw InvalidStatusTypeException::msg($requestedStatus, self::ALLOWED_STATUS);
        }
    }

    private function addHandledDate(): void
    {
        $this->handledDate = new \DateTime();
    }

    public function handledDate(): \DateTime|null
    {
        return $this->handledDate;
    }

    public function toArray(): array
    {
        return [
            'id'             => $this->id(),
            'productId'      => $this->product()->id(),
            'productName'    => $this->product()->name(),
            'brandId'        => $this->brand()->id(),
            'brandName'      => $this->brand()->name(),
            'influencerId'   => $this->influencer()->id(),
            'influencerName' => $this->influencer()->name(),
            'status'         => $this->status(),
            'shippind_id'    => $this->shipping()->id(),
            'shiping_status' => $this->shippingStatus(),
            'shipping_date'  => $this->shippedAt(),
            'comment'        => $this->comment(),
            'handledAt'      => $this->handledDate(),
        ];
    }
}
