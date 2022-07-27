<?php


namespace App\Domain\Contract;


use App\Domain\Influencer;

interface InfluencerRepositoryInterface
{
    public function add(Influencer $item): Influencer;

    public function findByName(string $name) : array;

    public function findById(int $id) : object|null;

    public function all(): array;
}