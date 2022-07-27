<?php


namespace App\Domain;


use App\Domain\Exception\NotAlphanumericItemException;

class Brand
{
    private $id;
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name)
    {
        if (!preg_match("/^[a-zA-Z0-9\s]*$/", $name)) {
            throw NotAlphanumericItemException::msg("only alphanumeric allowed : $name");
        }
        return new self($name);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function id(): int|null
    {
        return $this->id;
    }
}