<?php


namespace App\Request;


class AddProductRequest
{

    private string $productName;
    private int $brandId;

    public function __construct(string $productName, string $brandId)
    {
        $this->productName = $productName;
        $this->brandId = (int)$brandId;
    }

    public function brandId(): int
    {
        return $this->brandId;
    }

    public function name(): string
    {
        return $this->productName;
    }
}