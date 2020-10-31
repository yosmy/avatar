<?php

namespace Yosmy;

use Yosmy\Mongo;

class Avatars extends Mongo\Collection
{
    /**
     * @var BaseAvatar[]
     */
    protected $cursor;
}

