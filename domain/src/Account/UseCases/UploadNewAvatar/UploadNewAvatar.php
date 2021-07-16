<?php

namespace Domain\Account\UseCases\UploadNewAvatar;

use Domain\Account\Ports\AvatarsStoragePort;

class UploadNewAvatar
{
    private AvatarsStoragePort $avatarsStorage;

    public function __construct(AvatarsStoragePort $avatarsStorage)
    {
        $this->avatarsStorage = $avatarsStorage;
    }

    public function execute(UploadNewAvatarRequest $request, UploadNewAvatarPresenterInterface $presenter)
    {
        $response = new UploadNewAvatarResponse();

        if ($this->avatarsStorage->getAmountOfAvatarsForUsername($request->username) > 4) {
            $response->error = "{$request->username} cannot add a new avatar to its collection";
            $presenter->presents($response);
            return;
        }

        $this->avatarsStorage->uploadAvatarToUser($request->avatarContent, $request->username);
        $response->success = "{$request->username} successfully uploaded a new avatar";
        $presenter->presents($response);
    }
}
