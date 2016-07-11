<?php

namespace ApiBundle\Domain\Model\Tweet;

interface TweetCache
{
    /**
     * @param string $username
     * @param Tweet[] $tweets
     */
    public function set($username, $tweets);

    /**
     * @param string $username
     * @return Tweet[]|null
     */
    public function get($username);

    /**
     * @param string $username
     */
    public function delete($username);
}

