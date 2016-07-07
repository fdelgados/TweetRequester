<?php

namespace ApiBundle\Domain\Model\Tweet;

interface TweetService
{
    /**
     * @param string $username
     * @return Tweet[]
     */
    public function tweetsFrom($username);
}
