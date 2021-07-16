<?php

namespace Domain\Test\Account\Adapters;

use Domain\Account\Ports\AvatarsStoragePort;

class AvatarsStorageAdapter implements AvatarsStoragePort
{
    public function getAmountOfAvatarsForUsername(string $username): int
    {
        return match ($username) {
            "has_5_avatars" => 5,
            default => 0
        };
    }
}
