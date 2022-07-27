<?php


namespace App\Application\UseCase;


use App\Application\Exception\NotFoundException;
use App\Application\StatusChangeNotifierInterface;
use App\Domain\Contract\PartnerShipRepositoryInterface;
use App\Request\UpdatePartnershipStatusRequest;
use App\Response\UpdatePartnershipStatusResponse;

class UpdatePartnershipStatusUseCase
{
    private PartnerShipRepositoryInterface $partnerShipRepository;
    private StatusChangeNotifierInterface $statusChangeNotifier;

    public function __construct(PartnerShipRepositoryInterface $partnerShipRepository, StatusChangeNotifierInterface $statusChangeNotifier)
    {
        $this->partnerShipRepository = $partnerShipRepository;
        $this->statusChangeNotifier  = $statusChangeNotifier;
    }

    public function execute(UpdatePartnershipStatusRequest $updatePartnershipStatusRequest): UpdatePartnershipStatusResponse
    {
        $partnership = $this->partnerShipRepository->findById($updatePartnershipStatusRequest->id());

        if (is_null($partnership)) {
            throw NotFoundException::msg('Partnership Id ' . $updatePartnershipStatusRequest->id());
        }

        $newStatus = $updatePartnershipStatusRequest->newStatus();

        $previousPartnershipStatus = $partnership->status();

        $partnership->{$newStatus}();

        $this->partnerShipRepository->update($partnership);

        $this->statusChangeNotifier->collect($partnership->id(), $previousPartnershipStatus, $newStatus);
        $this->statusChangeNotifier->notify();

        return new UpdatePartnershipStatusResponse($partnership->id(), $partnership->shipping()->id(), $partnership->shipping()->status());
    }
}