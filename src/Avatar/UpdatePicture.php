<?php

namespace Yosmy\Avatar;

use Yosmy\Avatar;
use Yosmy\ManageAvatarCollection;

/**
 * @di\service()
 */
class UpdatePicture
{
    /**
     * @var SavePicture
     */
    private $savePicture;

    /**
     * @var DeletePicture
     */
    private $deletePicture;

    /**
     * @var ManageAvatarCollection
     */
    private $manageCollection;

    /**
     * @param SavePicture            $savePicture
     * @param DeletePicture          $deletePicture
     * @param ManageAvatarCollection $manageCollection
     */
    public function __construct(
        SavePicture $savePicture,
        DeletePicture $deletePicture,
        ManageAvatarCollection $manageCollection
    ) {
        $this->savePicture = $savePicture;
        $this->deletePicture = $deletePicture;
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string      $user
     * @param string|null $picture
     */
    public function update(
        string $user,
        ?string $picture
    ) {
        $file = '';

        if ($picture) {
            $file = $this->savePicture->save($picture);
        }

        /** @var Avatar $avatar */
        $avatar = $this->manageCollection->findOne([
            '_id' => $user,
        ]);

        if ($avatar->getPicture()) {
            $this->deletePicture->delete($avatar->getPicture());
        }

        $this->manageCollection->updateOne(
            [
                '_id' => $user,
            ],
            [
                '$set' => [
                    'picture' => $file,
                ]
            ]
        );
    }
}