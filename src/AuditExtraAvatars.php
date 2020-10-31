<?php

namespace Yosmy;

use Yosmy;
use Traversable;

/**
 * @di\service()
 */
class AuditExtraAvatars
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
        return $this->manageAvatarCollection->aggregate(
            [
                [
                    '$lookup' => [
                        'localField' => '_id',
                        'from' => $manageCollection->getName(),
                        'as' => 'parent',
                        'foreignField' => '_id',
                    ]
                ],
                [
                    '$match' => [
                        'parent._id' => [
                            '$exists' => false
                        ]
                    ],
                ]
            ]
        );
    }
}