<?php


namespace App\Application;


interface StatusChangeNotifierInterface
{
    public function collect(int $partnershipId, string $previousState, string $currentState) : void;
    public function notify() :void;
}