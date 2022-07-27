<?php

namespace App\Application\UseCase;

use App\Application\Exception\NotFoundException;
use App\Domain\Contract\BrandRepositoryInterface;
use App\Domain\Contract\InfluencerRepositoryInterface;
use App\Domain\Contract\PartnerShipRepositoryInterface;
use App\Domain\Contract\ProductRepositoryInterface;
use App\Domain\Contract\ShippingRepositoryInterface;
use App\Domain\Partnership;
use App\Domain\Shipping;
use App\Infrastructure\Persistence\Doctrine\Repositories\BrandRepository;
use App\Request\AddPartnershipRequest;
use App\Response\AddPartnershipResponse;


class AddPartnerShipUseCase
{
    private PartnerShipRepositoryInterface $partnershipRepository;
    private InfluencerRepositoryInterface $influencerRepository;
    private ProductRepositoryInterface $productRepository;
    private BrandRepositoryInterface $brandRepository;
    private ShippingRepositoryInterface $shippingRepository;

    public function __construct(
        PartnerShipRepositoryInterface $partnershipRepository,
        InfluencerRepositoryInterface $influencerRepository,
        ShippingRepositoryInterface $shippingRepository,
        ProductRepositoryInterface $productRepository,
        BrandRepository $brandRepository
    )
    {
        $this->partnershipRepository = $partnershipRepository;
        $this->influencerRepository  = $influencerRepository;
        $this->productRepository     = $productRepository;
        $this->brandRepository       = $brandRepository;
        $this->shippingRepository    = $shippingRepository;
    }

    public function execute(AddPartnershipRequest $addPartnershipRequest): AddPartnershipResponse
    {
        $influencer = $this->influencerRepository->findById($addPartnershipRequest->influencerId());

        if (is_null($influencer)) {
            throw NotFoundException::msg("Influencer id " . $addPartnershipRequest->influencerId());
        }

        $product = $this->productRepository->findById($addPartnershipRequest->productId());

        if (is_null($product)) {
            throw NotFoundException::msg("Product id " . $addPartnershipRequest->productId());
        }

        $brand = $this->brandRepository->findById($addPartnershipRequest->brandId());

        if (is_null($brand)) {
            throw NotFoundException::msg("Brand id " . $addPartnershipRequest->brandId());
        }

        $shipping = $this->shippingRepository->add(Shipping::create());

        $partnership = $this->partnershipRepository->add(
            new Partnership(
                $influencer, $product, $shipping, $addPartnershipRequest->comment())
        );

        return new AddPartnershipResponse(
            $partnership->id(),
            $partnership->product()->id(),
            $partnership->product()->name(),
            $partnership->brand()->id(),
            $partnership->brand()->name(),
            $partnership->influencer()->id(),
            $partnership->influencer()->name(),
            $partnership->shipping()->id(),
            $partnership->shipping()->status(),
            $partnership->comment(),
        );
    }

}
