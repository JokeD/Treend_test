<?php


namespace App\Domain\Contract;


use App\Domain\Partnership;

interface PartnerShipRepositoryInterface
{
    public function add(Partnership $item): Partnership;

    public function findByName(string $name): array;

    public function findById(int $id): object|null;

    public function update(object $partnership): void;

    public function all(): array;
}