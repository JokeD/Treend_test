<?php


namespace App\Ui\Http;


use App\Application\UseCase\AddProductUseCase;
use App\Application\UseCase\ListProductsUseCase;
use App\Request\AddProductRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductController
{
    private AddProductUseCase $addProductUseCase;
    private ListProductsUseCase $listProductsUseCase;

    public function __construct(AddProductUseCase $addProductUseCase, ListProductsUseCase $listProductsUseCase)
    {
        $this->addProductUseCase   = $addProductUseCase;
        $this->listProductsUseCase = $listProductsUseCase;
    }

    public function add(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->addProductUseCase->execute(
                new AddProductRequest(
                    $request->get('name'),
                    $request->get('brand_id')
                )
            )
        );
    }

    public function list(): JsonResponse
    {
        return new JsonResponse($this->listProductsUseCase->execute()->products());
    }

}