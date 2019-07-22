<?php

namespace Yosmy\Virtual;

use LogicException;

/**
 * @di\service()
 */
class GatherUser
{
    /**
     * @var PickUser
     */
    private $pickUser;

    /**
     * @param PickUser $pickUser
     */
    public function __construct(PickUser $pickUser)
    {
        $this->pickUser = $pickUser;
    }

    /**
     * @param string $id
     *
     * @return User
     */
    public function gather(
        string $id
    ) {
        try {
            return $this->pickUser->pick($id);
        } catch (NonexistentUserException $e) {
            throw new LogicException();
        }
    }
}
