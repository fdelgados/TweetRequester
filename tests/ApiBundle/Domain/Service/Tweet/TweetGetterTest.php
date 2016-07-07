<?php

namespace Tests\ApiBundle\Domain\Service\Tweet;

use ApiBundle\Domain\Service\Tweet\TweetGetter;
use ApiBundle\Infrastructure\Service\Tweet\InMemoryTweetAdapter;
use ApiBundle\Infrastructure\Service\Tweet\TranslatingTweetService;

class TweetGetterTest extends \PHPUnit_Framework_TestCase
{
    private $adapter;
    
    private $cache;
    
    private $tweetGetter;
    
    private $tweetService;
    
    protected function setUp()
    {
        $this->adapter = new InMemoryTweetAdapter();
        $this->cache = $this->getMockBuilder('ApiBundle\Infrastructure\Caching\Redis\RedisCache')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->tweetService = new TranslatingTweetService($this->adapter, $this->cache);
        $this->tweetGetter = new TweetGetter($this->tweetService);
    }

    /**
     * @test
     * @expectedException \ApiBundle\Infrastructure\Service\Tweet\TweetsNotFoundException
     */
    public function tryingToGetFakeUserTestMustThrowAnException()
    {
        $this->cache
            ->expects($this->once())
            ->method('get')
            ->willReturn(null);
        
        $this->tweetGetter->latestFromUser('fakeuser');
    }

    /**
     * @test
     */
    public function assertNumberOfTweetsIsCorrect()
    {
        $tweets = $this->tweetGetter->latestFromUser('existinguser');


        $this->assertTrue(count($tweets) <= TweetGetter::MAX_NUM_OF_TWEETS);
        $this->assertTrue(count($tweets) > 0);
    }
}
