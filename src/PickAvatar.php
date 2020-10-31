<?php

namespace Yosmy;

interface PickAvatar
{
    /**
     * @param string $user
     *
     * @return Avatar
     *
     * @throws NonexistentAvatarException
     */
    public function pick(
        string $user
    ): Avatar;
}