<?php

namespace Yosmy;

use LogicException;

/**
 * @di\service()
 */
class GatherAvatar
{
    /**
     * @var BasePickAvatar
     */
    private $pickAvatar;

    /**
     * @param BasePickAvatar $pickAvatar
     */
    public function __construct(BasePickAvatar $pickAvatar)
    {
        $this->pickAvatar = $pickAvatar;
    }

    /**
     * @param string $user
     *
     * @return Avatar
     */
    public function gather(
        string $user
    ): Avatar {
        try {
            return $this->pickAvatar->pick($user);
        } catch (NonexistentAvatarException $e) {
            throw new LogicException();
        }
    }
}
