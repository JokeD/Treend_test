<?php


namespace App\Domain\Exception;


class InvalidPartnershipStatusChangeTypeException extends \Exception
{
    public static function msg(string $currentStatus, string $requestedStatus): self
    {
        return new self("$requestedStatus is invalid, when current is $currentStatus");
    }
}