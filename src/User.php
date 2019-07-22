<?php

namespace Yosmy\Virtual;

use MongoDB\Model\BSONDocument;

/**
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class User extends BSONDocument
{
    /**
     * @param string $id
     * @param string $nickname
     * @param string $avatar
     */
    public function __construct(
        string $id,
        string $nickname,
        string $avatar
    ) {
        parent::__construct([
            'id' => $id,
            'nickname' => $nickname,
            'avatar' => $avatar,
        ]);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->offsetGet('id');
    }

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->offsetGet('nickname');
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->offsetGet('avatar');
    }

    /**
     * {@inheritdoc}
     */
    public function bsonUnserialize(array $data)
    {
        $data['id'] = $data['_id'];
        unset($data['_id']);

        parent::bsonUnserialize($data);
    }
}
