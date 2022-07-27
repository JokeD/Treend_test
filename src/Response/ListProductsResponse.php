<?php


namespace App\Response;


class ListProductsResponse
{
    private array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function products(): array
    {
        return $this->products;
    }
}