<?php

namespace App\Tests\Unit;


use App\Domain\Brand;
use App\Domain\Exception\InvalidPartnershipStatusChangeTypeException;
use App\Domain\Exception\NotAlphanumericItemException;
use App\Domain\Influencer;
use App\Domain\Partnership;
use App\Domain\Product;
use App\Domain\Shipping;
use Faker\Factory as Faker;
use PHPUnit\Framework\TestCase;

class MainAppTest extends TestCase
{

    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Faker::create();
    }

    public function testCantCreateAndRetrieveValidInfluencer()
    {
        $dummyInfluencerName = $this->faker->word();
        $dummyInfluencer     = Influencer::create($dummyInfluencerName);
        $this->assertEquals($dummyInfluencer->name(), $dummyInfluencerName);
    }

    public function testCreateAnInvalidNonAlphanumericInfluencerShouldThrowAnException()
    {
        $this->expectException(NotAlphanumericItemException::class);

        $dummyInfluencer = 'awfulFluencer!#';
        Influencer::create($dummyInfluencer);
    }

    public function testCanCreateAndRetrieveValidBrand()
    {
        $dummyBrand = $this->faker->word();

        $this->assertInstanceOf(Brand::class, Brand::create($dummyBrand));
        $this->assertEquals($dummyBrand, (Brand::create($dummyBrand)->name()));
    }

    public function testCreateAnInvalidNonAlphanumericBrandShouldThrowAnException()
    {
        $this->expectException(NotAlphanumericItemException::class);

        $dummyInvalidBrand = 'awful!#';
        Brand::create($dummyInvalidBrand);
    }

    public function testCanCreateAndRetrieveValidProduct()
    {
        $dummyBrandName   = $this->faker->word();
        $dummyProductName = $this->faker->word();

        $dummyProduct = Product::create(Brand::create($dummyBrandName), $dummyProductName);

        $this->assertInstanceOf(Product::class, $dummyProduct);
        $this->assertEquals($dummyProduct->name(), $dummyProductName);
        $this->assertEquals($dummyProduct->brand()->name(), $dummyBrandName);
    }

    public function testCanCreateAndRetrieveValidPartnership()
    {
        $dummyBrandName      = $this->faker->word();
        $dummyProductName    = $this->faker->word();
        $dummyInfluencerName = $this->faker->word();

        $dummyProduct    = Product::create(Brand::create($dummyBrandName), $dummyProductName);
        $dummyInfluencer = Influencer::create($dummyInfluencerName);
        $dummyShipping   = Shipping::create();
        $dummyComment    = $this->faker->paragraph(3);

        $dummyPartnership = new Partnership($dummyInfluencer, $dummyProduct, $dummyShipping, $dummyComment);

        $this->assertInstanceOf(Partnership::class, $dummyPartnership);

        $this->assertEquals($dummyPartnership->product()->name(), $dummyProductName);
        $this->assertEquals($dummyPartnership->brand()->name(), $dummyBrandName);
        $this->assertEquals($dummyPartnership->influencer()->name(), $dummyInfluencerName);
        $this->assertEquals($dummyPartnership->shipping()->status(), Shipping::SHIPPING_PENDING_STATUS);
        $this->assertEquals($dummyPartnership->status(), Partnership::STATUS_NEW);
        $this->assertEquals($dummyPartnership->comment(), $dummyComment);

    }

    public function testCanChangeFromAcceptedToFinishedPartnershipStates()
    {
        $dummyBrandName      = $this->faker->word();
        $dummyProductName    = $this->faker->word();
        $dummyInfluencerName = $this->faker->word();

        $dummyProduct    = Product::create(Brand::create($dummyBrandName), $dummyProductName);
        $dummyInfluencer = Influencer::create($dummyInfluencerName);
        $dummyShipping   = Shipping::create();
        $dummyComment    = $this->faker->paragraph(3);

        $dummyPartnership = new Partnership($dummyInfluencer, $dummyProduct, $dummyShipping, $dummyComment);

        $this->assertEquals($dummyPartnership->status(),$dummyPartnership::STATUS_NEW);

        $dummyPartnership->accepted();

        $this->assertEquals($dummyPartnership->status(),$dummyPartnership::STATUS_ACCEPTED);

        $dummyPartnership->finished();

        $this->assertEquals($dummyPartnership->status(),$dummyPartnership::STATUS_FINISHED);

    }

    public function testChangePartnershipFromAcceptedToRejectedShouldThrowAnException()
    {

        $dummyBrandName      = $this->faker->word();
        $dummyProductName    = $this->faker->word();
        $dummyInfluencerName = $this->faker->word();

        $dummyProduct    = Product::create(Brand::create($dummyBrandName), $dummyProductName);
        $dummyInfluencer = Influencer::create($dummyInfluencerName);
        $dummyShipping   = Shipping::create();
        $dummyComment    = $this->faker->paragraph(3);

        $dummyPartnership = new Partnership($dummyInfluencer, $dummyProduct, $dummyShipping, $dummyComment);

        $dummyPartnership->accepted();

        $this->expectException(InvalidPartnershipStatusChangeTypeException::class);

        $dummyPartnership->rejected();
    }

    public function testChangePartnershipFromCanceledToFinsishedShouldThrowAnException()
    {

        $dummyBrandName      = $this->faker->word();
        $dummyProductName    = $this->faker->word();
        $dummyInfluencerName = $this->faker->word();

        $dummyProduct    = Product::create(Brand::create($dummyBrandName), $dummyProductName);
        $dummyInfluencer = Influencer::create($dummyInfluencerName);
        $dummyShipping   = Shipping::create();
        $dummyComment    = $this->faker->paragraph(3);

        $dummyPartnership = new Partnership($dummyInfluencer, $dummyProduct, $dummyShipping, $dummyComment);

        $dummyPartnership->accepted();
        $dummyPartnership->finished();

        $this->expectException(InvalidPartnershipStatusChangeTypeException::class);

        $dummyPartnership->cancelled();
    }

    public function testChangePartnershipFromNewToAcceptedShouldFillHandledDate()
    {
        $dummyBrandName      = $this->faker->word();
        $dummyProductName    = $this->faker->word();
        $dummyInfluencerName = $this->faker->word();

        $dummyProduct    = Product::create(Brand::create($dummyBrandName), $dummyProductName);
        $dummyInfluencer = Influencer::create($dummyInfluencerName);
        $dummyShipping   = Shipping::create();
        $dummyComment    = $this->faker->paragraph(3);

        $dummyPartnership = new Partnership($dummyInfluencer, $dummyProduct, $dummyShipping, $dummyComment);

        $this->assertNull($dummyPartnership->shippedAt());

        $dummyPartnership->shipped();

        $this->assertNotNull($dummyPartnership->shippedAt());
    }

    public function testCanChangePartnershipShippingStates()
    {
        $dummyBrandName      = $this->faker->word();
        $dummyProductName    = $this->faker->word();
        $dummyInfluencerName = $this->faker->word();

        $dummyProduct    = Product::create(Brand::create($dummyBrandName), $dummyProductName);
        $dummyInfluencer = Influencer::create($dummyInfluencerName);
        $dummyShipping   = Shipping::create();
        $dummyComment    = $this->faker->paragraph(3);

        $dummyPartnership = new Partnership($dummyInfluencer, $dummyProduct, $dummyShipping, $dummyComment);

        $this->assertNull($dummyPartnership->shippedAt());

        $this->assertEquals($dummyPartnership->shipping()->status(), $dummyPartnership->shipping()::SHIPPING_PENDING_STATUS);

        $dummyPartnership->shipped();

        $this->assertEquals($dummyPartnership->shipping()->status(), $dummyPartnership->shipping()::SHIPPING_SHIPPED_STATUS);

        $dummyPartnership->received();

        $this->assertEquals($dummyPartnership->shipping()->status(), $dummyPartnership->shipping()::SHIPPING_RECEIVED_STATUS);

    }


}