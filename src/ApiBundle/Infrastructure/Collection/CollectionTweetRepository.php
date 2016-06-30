<?php

namespace ApiBundle\Infrastructure\Collection;

use ApiBundle\Domain\Model\Tweet\TweetRepository;

class CollectionTweetRepository implements TweetRepository
{
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
}
