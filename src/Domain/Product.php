<?php


namespace App\Domain;


class Product
{
    private $id;
    private string $name;
    private Brand $brand;

    private function __construct(Brand $brand, string $name)
    {
        $this->name  = $name;
        $this->brand = $brand;
    }

    public static function create(Brand $brand, string $name)
    {
        return new self($brand, $name);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function brand(): Brand
    {
        return $this->brand;
    }

    public function id(): int|null
    {
        return $this->id;
    }
}