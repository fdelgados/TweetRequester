<?php

namespace ApiBundle\Domain\Service;

use ApiBundle\Domain\Model\Tweet\TweetService;

class LastestTweetsService
{
    const MAX_NUM_OF_TWEETS = 10;

    /** @var TweetService */
    private $service;

    public function __construct(TweetService $service)
    {
        $this->service = $service;
    }

    public function execute($username)
    {
        $tweets = $this->service->tweetsFrom($username);

        if (self::MAX_NUM_OF_TWEETS > count($tweets)) {
            array_slice($tweets, 0, self::MAX_NUM_OF_TWEETS);
        }

        return $tweets;
    }
}
