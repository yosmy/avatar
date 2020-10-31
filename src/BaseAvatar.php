<?php

namespace Yosmy;

use Yosmy\Mongo;

class BaseAvatar extends Mongo\Document implements Avatar
{
    /**
     * @param string      $user
     * @param string      $nickname
     * @param string|null $picture
     */
    public function __construct(
        string $user,
        string $nickname,
        ?string $picture
    ) {
        parent::__construct([
            '_id' => $user,
            'nickname' => $nickname,
            'picture' => $picture,
        ]);
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->offsetGet('_id');
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->offsetGet('nickname');
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->offsetGet('picture');
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): object
    {
        $data = parent::jsonSerialize();

        $data->user = $data->_id;

        unset($data->_id);

        return $data;
    }
}
