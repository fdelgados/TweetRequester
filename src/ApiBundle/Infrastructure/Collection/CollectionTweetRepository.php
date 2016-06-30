<?php

namespace ApiBundle\Infrastructure\Collection;

use ApiBundle\Domain\Model\Tweet\Tweet;
use ApiBundle\Domain\Model\Tweet\TweetRepository;

class CollectionTweetRepository implements TweetRepository
{
    /** @var Tweet[] */
    private $tweets = [];

    /**
     * @inheritdoc
     */
    public function tweetOfId($id)
    {
        if (isset($this->tweets[$id])) {
            return $this->tweets[$id];
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function add(Tweet $tweet)
    {
        $this->tweets[$tweet->id()] = $tweet;
    }
}
