<?php

namespace ApiBundle\Domain\Model\Tweet;

interface TweetService
{
    public function tweetsFrom($username);
}
