<?php

namespace Domain\Account\Ports;

use Domain\Account\Entities\User;

interface AvatarsStoragePort
{
    public function getAmountOfAvatarsForUsername(string $username): int;

    public function uploadAvatarToUser(string $avatarContent, string $username): void;

    public function setAvatarsOf(string $username, array $avatars): void;
}
