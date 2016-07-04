<?php

namespace ApiBundle\Infrastructure\Caching\Redis;

use ApiBundle\Domain\Model\Tweet\TweetCache;
use Predis\Client as Redis;

class RedisCache implements TweetCache
{
    /** @var int */
    private static $keyExpirationInSeconds = 600;

    /** @var Redis */
    private $redis;

    /**
     * RedisCache constructor.
     * @param Redis $redis
     */
    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @inheritdoc
     */
    public function set($username, $tweets)
    {
        $username = md5($username);
        $this->redis->set($username, serialize($tweets));
        $this->redis->expire($username, self::$keyExpirationInSeconds);
    }

    /**
     * @inheritdoc
     */
    public function get($username)
    {
        $username = md5($username);
        if ($this->redis->exists($username)) {
            return unserialize($this->redis->get($username));
        }

        return null;
    }
}
