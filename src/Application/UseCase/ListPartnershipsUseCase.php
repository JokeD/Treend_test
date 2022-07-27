<?php


namespace App\Application\UseCase;



use App\Domain\Contract\PartnerShipRepositoryInterface;
use App\Response\ListPartnershipResponse;

class ListPartnershipsUseCase
{
    private PartnerShipRepositoryInterface $partnerShipRepository;

    public function __construct(PartnerShipRepositoryInterface $partnerShipRepository)
    {
        $this->partnerShipRepository = $partnerShipRepository;
    }

    public function execute(): ListPartnershipResponse
    {
        return new ListPartnershipResponse($this->partnerShipRepository->all());
    }
}