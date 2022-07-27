<?php


namespace App\Domain\Contract;


use App\Domain\Shipping;

interface ShippingRepositoryInterface
{
    public function add(Shipping $shipping): Shipping;

    public function findById(int $id): object|null;

    public function all(): array;
}