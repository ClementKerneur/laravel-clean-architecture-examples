<?php

namespace Domain\Test\Account\Adapters;

use Domain\Account\Ports\AvatarsStoragePort;

class AvatarsStorageAdapter implements AvatarsStoragePort
{
    public array $avatars = [
        "has_5_avatars" => ["1", "2", "3", "4", "5"],
        "has_3_avatars" => ["1", "2", "3"]
    ];

    public function getAmountOfAvatarsForUsername(string $username): int
    {
        return count($this->avatars[$username]);
    }

    public function uploadAvatarToUser(string $avatarContent, string $username): void
    {
        $this->avatars[$username][] = $avatarContent;
    }
}
