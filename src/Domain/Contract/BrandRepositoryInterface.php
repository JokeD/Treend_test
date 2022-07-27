<?php


namespace App\Domain\Contract;


use App\Domain\Brand;

interface BrandRepositoryInterface
{
    public function add(Brand $item): Brand;

    public function findByName(string $name) : array;

    public function findById(int $id) : object|null;

    public function all(): array;
}