<?php


namespace App\Ui\Http;


use App\Application\UseCase\AddPartnerShipUseCase;
use App\Application\UseCase\ListPartnershipsUseCase;
use App\Application\UseCase\UpdatePartnershipStatusUseCase;
use App\Request\AddPartnershipRequest;
use App\Request\UpdatePartnershipStatusRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PartnershipController
{
    private AddPartnerShipUseCase $addPartnerShipUseCase;
    private ListPartnershipsUseCase $listPartnershipsUseCase;
    private UpdatePartnershipStatusUseCase $updatePartnershipStatusUseCase;


    public function __construct(
        AddPartnerShipUseCase $addPartnerShipUseCase,
        ListPartnershipsUseCase $listPartnershipsUseCase,
        UpdatePartnershipStatusUseCase $updatePartnershipStatusUseCase
    )
    {
        $this->addPartnerShipUseCase          = $addPartnerShipUseCase;
        $this->updatePartnershipStatusUseCase = $updatePartnershipStatusUseCase;
        $this->listPartnershipsUseCase        = $listPartnershipsUseCase;
    }

    public function add(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->addPartnerShipUseCase->execute(
                new AddPartnershipRequest(
                    $request->get('product_id'),
                    $request->get('brand_id'),
                    $request->get('influencer_id'),
                    $request->get('comment')
                )
            )
        );
    }

    public function statusUpdate(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->updatePartnershipStatusUseCase->execute(
                new UpdatePartnershipStatusRequest($request->get('id'), $request->get('new_status'))
            )
        );
    }

    public function list(): JsonResponse
    {
        return new JsonResponse($this->listPartnershipsUseCase->execute()->partnerships());
    }

}