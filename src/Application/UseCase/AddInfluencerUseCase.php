<?php


namespace App\Application\UseCase;


use App\Domain\Contract\InfluencerRepositoryInterface;
use App\Domain\Influencer;
use App\Request\AddInfluencerRequest;
use App\Response\AddInfluencerResponse;

class AddInfluencerUseCase
{
    private InfluencerRepositoryInterface $influencerRepository;

    public function __construct(InfluencerRepositoryInterface $influencerRepository)
    {
        $this->influencerRepository = $influencerRepository;
    }

    public function execute(AddInfluencerRequest $addInfluencerRequest) : AddInfluencerResponse
    {
        $influencer = $this->influencerRepository->add(Influencer::create($addInfluencerRequest->name()));
        return new AddInfluencerResponse($influencer->id(),$influencer->name());
    }
}