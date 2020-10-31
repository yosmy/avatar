<?php

namespace Yosmy;

use Yosmy\Mongo;

class BaseManageAvatarCollection extends Mongo\BaseManageCollection implements ManageAvatarCollection
{
    /**
     * @param string $uri
     * @param string $db
     * @param string $collection
     * @param string $root
     */
    public function __construct(
        string $uri,
        string $db,
        string $collection,
        string $root
    ) {
        parent::__construct(
            $uri,
            $db,
            $collection,
            [
                'typeMap' => array(
                    'root' => $root,
                ),
            ]
        );
    }
}
