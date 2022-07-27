<?php


namespace App\Response;


class AddProductResponse implements \JsonSerializable
{
    private int $id;
    private string $name;
    private int $brandId;
    private string $brandName;

    public function __construct(int $id, string $name, int $brandId, string $brandName)
    {
        $this->id        = $id;
        $this->name      = $name;
        $this->brandId   = $brandId;
        $this->brandName = $brandName;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function brandId(): int
    {
        return $this->brandId;
    }

    public function brandName(): string
    {
        return $this->brandName;
    }

    public function jsonSerialize(): array
    {
        return [
            'status'     => 'created',
            'id'         => $this->id(),
            'name'       => $this->name(),
            'brand_id'   => $this->brandId(),
            'brand_name' => $this->brandName()
        ];
    }
}