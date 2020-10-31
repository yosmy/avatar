<?php

namespace Yosmy\Avatar;

use Yosmy\ManageAvatarCollection;

/**
 * @di\service()
 */
class UpdateNickname
{
    /**
     * @var ManageAvatarCollection
     */
    private $manageCollection;

    /**
     * @param ManageAvatarCollection $manageCollection
     */
    public function __construct(
        ManageAvatarCollection $manageCollection
    ) {
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string $user
     * @param string $nickname
     */
    public function update(
        string $user,
        string $nickname
    ) {
        $this->manageCollection->updateOne(
            [
                '_id' => $user,
            ],
            [
                '$set' => [
                    'nickname' => $nickname,
                ]
            ]
        );
    }
}