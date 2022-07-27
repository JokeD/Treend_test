<?php


namespace App\Infrastructure\Persistence\FileSystem;


use App\Application\StatusChangeNotifierInterface;

class StatusChangeNotifier implements StatusChangeNotifierInterface
{
    private int $partnershipId;
    private string $previousState;
    private string $currentState;


    public function collect(int $partnershipId, string $previousState, string $currentState): void
    {

        $this->partnershipId = $partnershipId;
        $this->previousState = $previousState;
        $this->currentState  = $currentState;
    }

    public function notify(): void
    {
        $file    = realpath(getcwd() . '/../var/log') . '/notifier.json';

        $content = [
            'partnershipId' => $this->partnershipId,
            'previousState' => $this->previousState,
            'currentState'  => $this->currentState
        ];

        $previousData = json_decode(file_get_contents($file),1);
        array_push($previousData, $content);
        file_put_contents($file, json_encode($previousData));
    }
}