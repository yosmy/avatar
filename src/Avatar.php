<?php

namespace Yosmy;

interface Avatar
{
    /**
     * @return string
     */
    public function getUser(): string;

    /**
     * @return string
     */
    public function getNickname(): string;

    /**
     * @return string|null
     */
    public function getPicture(): ?string;
}
