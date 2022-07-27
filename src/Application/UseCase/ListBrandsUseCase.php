<?php


namespace App\Application\UseCase;


use App\Domain\Contract\BrandRepositoryInterface;
use App\Request\ListBrandRequest;
use App\Response\ListBrandsResponse;

class ListBrandsUseCase
{
    private BrandRepositoryInterface $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function execute(): ListBrandsResponse
    {
        return new ListBrandsResponse($this->brandRepository->all());
    }
}