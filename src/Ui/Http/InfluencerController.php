<?php


namespace App\Ui\Http;


use App\Application\UseCase\AddInfluencerUseCase;
use App\Application\UseCase\ListInfluencersUseCase;
use App\Request\AddInfluencerRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InfluencerController
{
    private AddInfluencerUseCase $addInfluencerUseCase;
    private ListInfluencersUseCase $listInfluencersUseCase;

    public function __construct(AddInfluencerUseCase $addInfluencerUseCase, ListInfluencersUseCase $listInfluencersUseCase)
    {
        $this->addInfluencerUseCase   = $addInfluencerUseCase;
        $this->listInfluencersUseCase = $listInfluencersUseCase;
    }

    public function add(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->addInfluencerUseCase->execute(new AddInfluencerRequest($request->get('name')))
        );
    }

    public function list(): JsonResponse
    {
        return new JsonResponse($this->listInfluencersUseCase->execute()->influencers());
    }

}