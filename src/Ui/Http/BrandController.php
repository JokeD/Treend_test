<?php


namespace App\Ui\Http;


use App\Application\UseCase\AddBrandUseCase;
use App\Application\UseCase\ListBrandsUseCase;
use App\Request\AddBrandRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BrandController
{
    private AddBrandUseCase $addBrandUseCase;
    private ListBrandsUseCase $listBrandsUseCase;

    public function __construct(AddBrandUseCase $addBrandUseCase, ListBrandsUseCase $listBrandsUseCase)
    {
        $this->addBrandUseCase   = $addBrandUseCase;
        $this->listBrandsUseCase = $listBrandsUseCase;
    }

    public function add(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->addBrandUseCase->execute(new AddBrandRequest($request->get('name')))
        );
    }

    public function list(): JsonResponse
    {
        return new JsonResponse($this->listBrandsUseCase->execute()->brands());
    }

}