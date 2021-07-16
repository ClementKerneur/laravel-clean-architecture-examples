<?php

namespace Domain\Test\Account\UseCases;

use Domain\Account\UseCases\UploadNewAvatar\UploadNewAvatar;
use Domain\Account\UseCases\UploadNewAvatar\UploadNewAvatarPresenterInterface;
use Domain\Account\UseCases\UploadNewAvatar\UploadNewAvatarRequest;
use Domain\Account\UseCases\UploadNewAvatar\UploadNewAvatarResponse;
use Domain\Test\Account\Adapters\AvatarsStorageAdapter;
use PHPUnit\Framework\TestCase;

class UploadNewAvatarTest extends TestCase implements UploadNewAvatarPresenterInterface
{
    public UploadNewAvatarResponse $response;

    public function presents(UploadNewAvatarResponse $response): void
    {
        $this->response = $response;
    }

    public function test_the_response_has_an_error_if_user_already_has_at_least_4_avatar()
    {
        $storage = new AvatarsStorageAdapter();
        $useCase = new UploadNewAvatar($storage);
        $request = new UploadNewAvatarRequest();

        $request->username = "has_5_avatars";
        $request->avatarContent = "new avatar";

        $useCase->execute($request, $this);

        $this->assertNotNull($this->response->error);
        $this->assertNotContains("new avatar", $storage->avatars["has_5_avatars"]);
        $this->assertCount(5, $storage->avatars["has_5_avatars"]);
    }

    public function test_the_response_has_a_success_message_if_user_has_less_than_4_avatars()
    {
        $storage = new AvatarsStorageAdapter();
        $useCase = new UploadNewAvatar($storage);
        $request = new UploadNewAvatarRequest();

        $request->username = "has_3_avatars";
        $request->avatarContent = "new avatar";

        $useCase->execute($request, $this);

        $this->assertNotNull($this->response->success);
        $this->assertContains("new avatar", $storage->avatars["has_3_avatars"]);
        $this->assertCount(4, $storage->avatars["has_3_avatars"]);
    }
}
