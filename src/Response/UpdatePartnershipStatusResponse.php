<?php


namespace App\Response;


class UpdatePartnershipStatusResponse implements \JsonSerializable
{
    private int $id;
    private string $newStatus;
    private int $shippingId;

    public function __construct(int $id, int $shippingId, string $newStatus)
    {
        $this->id         = $id;
        $this->shippingId = $shippingId;
        $this->newStatus  = $newStatus;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function shippindId(): int
    {
        return $this->shippingId;
    }

    public function newStatus(): string
    {
        return $this->newStatus;
    }

    public function jsonSerialize(): array
    {
        return [
            'status'     => 'udpated',
            'id'         => $this->id(),
            'shipping_id'=> $this->shippindId(),
            'new_status' => $this->newStatus()
        ];
    }
}