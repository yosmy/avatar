<?php

namespace Yosmy\Virtual\User;

use Yosmy\Virtual\ManageUserCollection;
use Yosmy\Virtual\User;

/**
 * @di\service()
 */
class UpdateAvatar
{
    /**
     * @var SaveAvatar
     */
    private $saveAvatar;

    /**
     * @var DeleteAvatar
     */
    private $deleteAvatar;

    /**
     * @var ManageUserCollection
     */
    private $manageCollection;

    /**
     * @param SaveAvatar           $saveAvatar
     * @param DeleteAvatar         $deleteAvatar
     * @param ManageUserCollection $manageCollection
     */
    public function __construct(
        SaveAvatar $saveAvatar,
        DeleteAvatar $deleteAvatar,
        ManageUserCollection $manageCollection
    ) {
        $this->saveAvatar = $saveAvatar;
        $this->deleteAvatar = $deleteAvatar;
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string      $id
     * @param string|null $avatar
     */
    public function update(
        string $id,
        ?string $avatar
    ) {
        $file = '';

        if ($avatar) {
            $file = $this->saveAvatar->save($avatar);
        }

        /** @var User $user */
        $user = $this->manageCollection->findOne([
            '_id' => $id,
        ]);

        if ($user->getAvatar()) {
            $this->deleteAvatar->delete($user->getAvatar());
        }

        $this->manageCollection->updateOne(
            [
                '_id' => $id,
            ],
            [
                '$set' => [
                    'avatar' => $file,
                ]
            ]
        );
    }
}