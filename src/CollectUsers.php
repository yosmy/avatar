<?php

namespace Yosmy\Virtual;

/**
 * @di\service()
 */
class CollectUsers
{
    /**
     * @var ManageUserCollection
     */
    private $manageCollection;

    /**
     * @param ManageUserCollection $manageCollection
     */
    public function __construct(ManageUserCollection $manageCollection)
    {
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string[] $ids
     *
     * @return Users
     */
    public function collect(
        array $ids
    ) {
        $cursor = $this->manageCollection->find([
            '_id' => [
                '$in' => $ids,
            ]
        ]);

        return new Users($cursor);
    }
}
