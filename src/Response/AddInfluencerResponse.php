<?php


namespace App\Response;


class AddInfluencerResponse implements \JsonSerializable
{
    private int $id;
    private $name;

    public function __construct(int $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): array
    {
        return [
            'status' => 'created',
            'id'     => $this->id(),
            'name'   => $this->name()
        ];
    }
}