<?php


namespace App\Response;


class ListInfluencersResponse
{
    private array $influencers;

    public function __construct(array $influencers)
    {
        $this->influencers = $influencers;
    }

    public function influencers(): array
    {
        return $this->influencers;
    }
}