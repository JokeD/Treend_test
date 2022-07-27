<?php


namespace App\Domain;


use App\Domain\Exception\NotAlphanumericItemException;

class Influencer
{
    private $id;
    private string $name;

    private function __construct(string $name, $id = null)
    {
        $this->name = $name;
        $this->id   = $id;
    }

    public static function create(string $name, int $id = null)
    {
        if (!preg_match("/^[a-zA-Z0-9\s]*$/", $name)) {
            throw NotAlphanumericItemException::msg("only alphanumeric allowed");
        }
        return new self($name, $id);
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