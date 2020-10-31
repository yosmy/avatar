<?php

namespace Yosmy;

/**
 * @di\service()
 */
class CollectAvatars
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
     * @param string[] $users
     *
     * @return Avatars
     */
    public function collect(
        array $users
    ): Avatars {
        $cursor = $this->manageCollection->find([
            '_id' => [
                '$in' => $users,
            ]
        ]);

        return new Avatars($cursor);
    }
}
