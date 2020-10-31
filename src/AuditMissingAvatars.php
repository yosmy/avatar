<?php

namespace Yosmy;

use Yosmy;
use Traversable;

/**
 * @di\service()
 */
class AuditMissingAvatars
{
    /**
     * @var ManageAvatarCollection
     */
    private $manageAvatarCollection;

    /**
     * @param ManageAvatarCollection $manageAvatarCollection
     */
    public function __construct(
        ManageAvatarCollection $manageAvatarCollection
    ) {
        $this->manageAvatarCollection = $manageAvatarCollection;
    }

    /**
     * @param Yosmy\Mongo\ManageCollection $manageCollection
     *
     * @return Traversable
     */
    public function audit(
        Yosmy\Mongo\ManageCollection $manageCollection
    ): Traversable
    {
        return $manageCollection->aggregate(
            [
                [
                    '$lookup' => [
                        'localField' => '_id',
                        'from' => $this->manageAvatarCollection->getName(),
                        'as' => 'avatars',
                        'foreignField' => '_id',
                    ]
                ],
                [
                    '$match' => [
                        'avatars._id' => [
                            '$exists' => false
                        ]
                    ],
                ]
            ]
        );
    }
}