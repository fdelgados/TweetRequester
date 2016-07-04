<?php

namespace ApiBundle\Domain\Model\Tweet;

interface TweetAdapter
{
    public function transformToTweets($username);
}
