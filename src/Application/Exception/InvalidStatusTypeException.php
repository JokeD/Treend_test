<?php


namespace App\Application\Exception;


class InvalidStatusTypeException extends \Exception
{
    public static function msg(string $currentStatus, array $allowedStatus): self
    {
        return new self("$currentStatus is invalid, only allowed " . implode(',', $allowedStatus));
    }
}