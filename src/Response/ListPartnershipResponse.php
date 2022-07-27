<?php


namespace App\Response;


class ListPartnershipResponse
{
    private array $partnerships;

    public function __construct(array $partnerships)
    {
        $this->partnerships = $partnerships;
    }

    public function partnerships(): array
    {
        return $this->partnerships;
    }
}