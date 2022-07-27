<?php


namespace App\Application\UseCase;


use App\Domain\Brand;
use App\Domain\Contract\BrandRepositoryInterface;
use App\Request\AddBrandRequest;
use App\Response\AddBrandResponse;

class AddBrandUseCase
{
    private BrandRepositoryInterface $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function execute(AddBrandRequest $addBrandRequest) : AddBrandResponse
    {
        $brand = $this->brandRepository->add(Brand::create($addBrandRequest->name()));
        return new AddBrandResponse($brand->id(),$brand->name());
    }
}