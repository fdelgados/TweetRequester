<?php

namespace ApiBundle\Infrastructure\Service\Tweet;

use ApiBundle\Domain\Model\Tweet\TweetCache;
use ApiBundle\Domain\Model\Tweet\TweetService;
use ApiBundle\Domain\Model\Tweet\TweetAdapter;

class TranslatingTweetService implements TweetService
{
    /** @var TweetAdapter */
    private $adapter;

    private $cache;

    public function __construct(TweetAdapter $adapter, TweetCache $cache)
    {
        $this->adapter = $adapter;
        $this->cache = $cache;
    }

    /**
     * @inheritdoc
     */
    public function tweetsFrom($username)
    {
        $tweetsFromCache = $this->cache->get($username);
        if (null !== $tweetsFromCache) {
            return $tweetsFromCache;
        }
        $tweets = $this->adapter->transformToTweets($username);
        $this->guardFromNoTweetsFound($tweets);
        
        $this->cache->set($username, $tweets);

        return $tweets;
    }

    /**
     * @param $tweets
     * @throws TweetsNotFoundException
     */
    private function guardFromNoTweetsFound($tweets)
    {
        if (empty($tweets)) {
            throw new TweetsNotFoundException('No tweets');
        }
    }
}
