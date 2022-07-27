<?php


namespace App\Domain\Contract;


use App\Domain\Product;

interface ProductRepositoryInterface
{
    public function add(Product $item): Product;

    public function findByName(string $name) : array;

    public function findById(int $id) : object|null;

    public function all(): array;
}