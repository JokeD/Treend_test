<?php


namespace App\Request;


class AddPartnershipRequest
{

    private string $productId;
    private string $brandId;
    private string $influencerId;
    private string $comment;

    public function __construct(string $productId, string $brandId, string $influencerId, string $comment)
    {
        $this->productId    = (int)$productId;
        $this->brandId      = (int)$brandId;
        $this->influencerId = (int)$influencerId;
        $this->comment      = $comment;
    }

    public function influencerId(): int
    {
        return $this->influencerId;
    }

    public function productId(): int
    {
        return $this->productId;
    }

    public function brandId(): int
    {
        return $this->brandId;
    }

    public function comment(): string
    {
        return $this->comment;
    }


}