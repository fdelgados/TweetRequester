<?php

namespace ApiBundle\Domain\Model\Tweet;

interface TweetRepository
{
    /**
     * @param string $id
     *
     * @return Tweet
     */
    public function tweetOfId($id);

    /**
     * @param Tweet $tweet
     */
    public function add(Tweet $tweet);
}
