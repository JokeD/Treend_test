<?php


namespace App\Application\UseCase;


use App\Application\Exception\NotFoundException;
use App\Domain\Contract\BrandRepositoryInterface;
use App\Domain\Contract\ProductRepositoryInterface;
use App\Domain\Product;
use App\Request\AddProductRequest;
use App\Response\AddProductResponse;

class AddProductUseCase
{
    private ProductRepositoryInterface $productRepository;
    private BrandRepositoryInterface $brandRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        BrandRepositoryInterface $brandRepository,
    )
    {
        $this->productRepository = $productRepository;
        $this->brandRepository   = $brandRepository;
    }

    public function execute(AddProductRequest $productRequest): AddProductResponse
    {
        $brand = $this->brandRepository->findById($productRequest->brandId());

        if (is_null($brand)) {
            throw NotFoundException::msg("Brand id ".$productRequest->brandId());
        }
        $product = $this->productRepository->add(
            Product::create($brand, $productRequest->name())
        );

        return new AddProductResponse($product->id(),$product->name(),$product->brand()->id(),$product->brand()->name());
    }

}