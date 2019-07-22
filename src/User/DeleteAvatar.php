<?php

namespace Yosmy\Virtual\User;

/**
 * @di\service()
 */
class DeleteAvatar
{
    /**
     * @var string
     */
    private $dir;

    /**
     * @di\arguments({
     *     dir: '%yosmy_virtual_user_avatar_dir%'
     * })
     *
     * @param string $dir
     */
    public function __construct(
        string $dir
    ) {
        $this->dir = $dir;
    }

    /**
     * @param string $avatar
     */
    public function delete(
        string $avatar
    ) {
        sprintf('%s/%s', $this->dir, $avatar);
    }
}