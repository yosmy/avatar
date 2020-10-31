<?php

namespace Yosmy\Avatar;

/**
 * @di\service()
 */
class DeletePicture
{
    /**
     * @var string
     */
    private $dir;

    /**
     * @di\arguments({
     *     dir: '%avatar_dir%'
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
     * @param string $picture
     */
    public function delete(
        string $picture
    ) {
        unlink(sprintf('%s/%s', $this->dir, $picture));
    }
}