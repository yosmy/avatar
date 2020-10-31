<?php

namespace Yosmy\Avatar;

/**
 * @di\service({
 *     private: true
 * })
 */
class SavePicture
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
     *
     * @return string
     */
    public function save(
        string $picture
    ): string {
        // Remove type 'data:image/jpeg;base64'
        $picture = explode(',', $picture);
        $picture = $picture[1];

        $file = sprintf('%s.jpeg', md5($picture));

        file_put_contents(
            sprintf('%s/%s', $this->dir, $file),
            base64_decode($picture)
        );

        return $file;
    }
}