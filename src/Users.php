<?php

namespace Yosmy\Virtual;

use Yosmy\Mongo;

class Users extends Mongo\Cursor
{
    /**
     * @var User[]
     */
    protected $cursor;
}

