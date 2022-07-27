<?php


namespace App\Application\Exception;


class NotFoundException extends \Exception
{
    public static function msg(string $subject): self
    {
        return new self(" $subject not found. ");
    }
}