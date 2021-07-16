<?php

namespace Domain\Account\UseCases\UploadNewAvatar;

interface UploadNewAvatarPresenterInterface
{
    public function presents(UploadNewAvatarResponse $response): void;
}
