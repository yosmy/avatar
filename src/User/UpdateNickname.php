<?php

namespace Yosmy\Virtual\User;

use Yosmy\Virtual\ManageUserCollection;

/**
 * @di\service()
 */
class UpdateNickname
{
    /**
     * @var ManageUserCollection
     */
    private $manageCollection;

    /**
     * @param ManageUserCollection $manageCollection
     */
    public function __construct(
        ManageUserCollection $manageCollection
    ) {
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string $id
     * @param string $nickname
     */
    public function update(
        string $id,
        string $nickname
    ) {
        $this->manageCollection->updateOne(
            [
                '_id' => $id,
            ],
            [
                '$set' => [
                    'nickname' => $nickname,
                ]
            ]
        );
    }
}