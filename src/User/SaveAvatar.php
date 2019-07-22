<?php

namespace Yosmy\Virtual\User;

/**
 * @di\service()
 */
class SaveAvatar
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
     *
     * @return string
     */
    public function save(
        string $avatar
    ) {
        // Remove type 'data:image/jpeg;base64'
        $avatar = explode(',', $avatar);
        $avatar = $avatar[1];

        $file = sprintf('%s.jpeg', md5($avatar));

        file_put_contents(
            sprintf('%s/%s', $this->dir, $file),
            base64_decode($avatar)
        );

        return $file;
    }
}