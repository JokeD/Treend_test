<?php


namespace App\Response;


class ListBrandsResponse
{
    private array $brands;

    public function __construct(array $brands)
    {
        $this->brands = $brands;
    }

    public function brands(): array
    {
        return $this->brands;
    }
}