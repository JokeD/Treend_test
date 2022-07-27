<?php


namespace App\Domain\Exception;


class NotAlphanumericItemException extends \Exception
{
    public static function msg(string $msg = ''): self
    {
        return new self("only alphanumeric is allowed : $msg");
    }
}