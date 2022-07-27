<?php


namespace App\Application\UseCase;


use App\Domain\Contract\InfluencerRepositoryInterface;
use App\Response\ListInfluencersResponse;

class ListInfluencersUseCase
{
    private InfluencerRepositoryInterface $influencerRepository;

    public function __construct(InfluencerRepositoryInterface $influencerRepository)
    {
        $this->influencerRepository = $influencerRepository;
    }

    public function execute(): ListInfluencersResponse
    {
        return new ListInfluencersResponse($this->influencerRepository->all());
    }
}