<?php


namespace App\Application\UseCase;



use App\Domain\Contract\ProductRepositoryInterface;
use App\Response\ListProductsResponse;

class ListProductsUseCase
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): ListProductsResponse
    {
        return new ListProductsResponse($this->productRepository->all());
    }
}