<?php

namespace ApiBundle\Domain\Service\Tweet;

use ApiBundle\Domain\Model\Tweet\TweetService;
use ApiBundle\Infrastructure\Service\Tweet\TweetsNotFoundException;

class TweetGetter
{
    const MAX_NUM_OF_TWEETS = 10;

    /** @var TweetService */
    private $service;

    public function __construct(TweetService $service)
    {
        $this->service = $service;
    }

    public function latestFromUser($username)
    {
        try {
            $tweets = $this->service->tweetsFrom($username);
        } catch (TweetsNotFoundException $e) {
            throw $e;
        }
        
        if (self::MAX_NUM_OF_TWEETS < count($tweets)) {
            $tweets = array_slice($tweets, 0, self::MAX_NUM_OF_TWEETS);
        }

        return $tweets;
    }
}
