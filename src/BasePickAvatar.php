<?php

namespace Yosmy;

/**
 * @di\service()
 */
class BasePickAvatar implements PickAvatar
{
    /**
     * @var ManageAvatarCollection
     */
    private $manageCollection;

    /**
     * @param ManageAvatarCollection $manageCollection
     */
    public function __construct(ManageAvatarCollection $manageCollection)
    {
        $this->manageCollection = $manageCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function pick(
        string $user
    ): Avatar {
        /** @var Avatar $avatar */
        $avatar = $this->manageCollection->findOne([
            '_id' => $user
        ]);

        if ($avatar === null) {
            throw new BaseNonexistentAvatarException();
        }

        return $avatar;
    }
}
