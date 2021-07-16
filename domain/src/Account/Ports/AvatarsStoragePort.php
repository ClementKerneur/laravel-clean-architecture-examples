<?php

namespace Domain\Account\Ports;

interface AvatarsStoragePort
{
    public function getAmountOfAvatarsForUsername(string $username): int;
}
