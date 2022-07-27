<?php


namespace App\Request;


class UpdatePartnershipStatusRequest
{
    private int $id;
    private string $newStatus;

    public function __construct(string $id, string $newStatus)
    {
        $this->id        = (int)$id;
        $this->newStatus = $newStatus;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function newStatus(): string
    {
        return $this->newStatus;
    }
}