<?php

namespace Yosmy\Virtual;

/**
 * @di\service()
 */
class AddUser
{
    /**
     * @var User\SaveAvatar
     */
    private $saveAvatar;

    /**
     * @var ManageUserCollection
     */
    private $manageCollection;

    /**
     * @param User\SaveAvatar      $saveAvatar
     * @param ManageUserCollection $manageCollection
     */
    public function __construct(
        User\SaveAvatar $saveAvatar,
        ManageUserCollection $manageCollection
    ) {
        $this->saveAvatar = $saveAvatar;
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string      $id
     * @param string      $nickname
     * @param string|null $avatar
     */
    public function add(
        string $id,
        string $nickname,
        ?string $avatar
    ) {
        $file = '';

        if ($avatar) {
            $file = $this->saveAvatar->save($avatar);
        }

        $this->manageCollection->insertOne([
            '_id' => $id,
            'nickname' => $nickname,
            'avatar' => $file
        ]);
    }
}