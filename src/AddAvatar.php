<?php

namespace Yosmy;

/**
 * @di\service()
 */
class AddAvatar
{
    /**
     * @var Avatar\SavePicture
     */
    private $savePicture;

    /**
     * @var ManageAvatarCollection
     */
    private $manageCollection;

    /**
     * @param Avatar\SavePicture     $savePicture
     * @param ManageAvatarCollection $manageCollection
     */
    public function __construct(
        Avatar\SavePicture $savePicture,
        ManageAvatarCollection $manageCollection
    ) {
        $this->savePicture = $savePicture;
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string      $user
     * @param string      $nickname
     * @param string|null $picture
     */
    public function add(
        string $user,
        string $nickname,
        ?string $picture
    ) {
        $file = '';

        if ($picture) {
            $file = $this->savePicture->save($picture);
        }

        $this->manageCollection->insertOne([
            '_id' => $user,
            'nickname' => $nickname,
            'picture' => $file
        ]);
    }
}