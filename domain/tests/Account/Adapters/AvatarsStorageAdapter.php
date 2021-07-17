<?php

namespace Domain\Test\Account\Adapters;

use Domain\Account\Ports\AvatarsStoragePort;

class AvatarsStorageAdapter implements AvatarsStoragePort
{
    public array $avatars = [];

    public function getAmountOfAvatarsForUsername(string $username): int
    {
        return count($this->avatars[$username]);
    }

    public function uploadAvatarToUser(string $avatarContent, string $username): void
    {
        $this->avatars[$username][] = $avatarContent;
    }

    public function setAvatarsOf(string $username, array $avatars): void
    {
        $this->avatars[$username] = $avatars;
    }
}
