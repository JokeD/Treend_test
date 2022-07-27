<?php


namespace App\Response;


class AddPartnershipResponse implements \JsonSerializable
{
    private $id;
    private string $productId;
    private string $brandId;
    private string $influencerId;
    private string $comment;
    private string $productName;
    private string $brandName;
    private string $influencerName;
    private int $shippingId;
    private string $shippingStatus;

    public function __construct(
        int $id,
        int $productId,
        string $productName,
        int $brandId,
        string $brandName,
        int $influencerId,
        string $influencerName,
        int $shippingId,
        string $shippingStatus,
        string $comment
    )
    {
        $this->id             = $id;
        $this->productId      = $productId;
        $this->brandId        = $brandId;
        $this->influencerId   = $influencerId;
        $this->comment        = $comment;
        $this->productName    = $productName;
        $this->brandName      = $brandName;
        $this->influencerName = $influencerName;
        $this->shippingId     = $shippingId;
        $this->shippingStatus = $shippingStatus;
    }

    public function influencerId(): int
    {
        return $this->influencerId;
    }

    public function influencerName(): string
    {
        return $this->influencerName;
    }

    public function productId(): int
    {
        return $this->productId;
    }

    public function productName(): string
    {
        return $this->productName;
    }

    public function brandId(): int
    {
        return $this->brandId;
    }

    public function brandName(): string
    {
        return $this->brandName;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function comment(): string
    {
        return $this->comment;
    }

    public function shippingStatus(): string
    {
        return $this->shippingStatus;
    }

    public function shippingId(): int
    {
        return $this->shippingId;
    }

    public function jsonSerialize()
    {
        return [
            'status'         => 'created',
            'id'             => $this->id(),
            'productId'      => $this->productId(),
            'productName'    => $this->productName(),
            'brandId'        => $this->brandId(),
            'brandName'      => $this->brandName(),
            'influencerId'   => $this->influencerId(),
            'influencerName' => $this->influencerName(),
            'shippind_id'    => $this->shippingId(),
            'shiping_status' => $this->shippingStatus(),
            'comment'        => $this->comment()
        ];
    }
}