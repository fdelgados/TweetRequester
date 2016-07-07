<?php

namespace Tests\ApiBundle\Application\Service\Tweet;

use ApiBundle\Application\Service\Tweet\GetLatestTweetsRequest;
use ApiBundle\Application\Service\Tweet\GetLatestTweetsResponse;
use ApiBundle\Domain\Service\Tweet\TweetGetter;
use ApiBundle\Infrastructure\Service\Tweet\InMemoryTweetAdapter;
use ApiBundle\Infrastructure\Service\Tweet\TranslatingTweetService;
use ApiBundle\Application\Service\Tweet\GetLatestTweetsService;

class GetLatestTweetsServiceTest extends \PHPUnit_Framework_TestCase
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
     */
    public function requestFakeUserTweetsMustReturnAnEmptyResponse()
    {
        $getLatestTweetsRequest = new GetLatestTweetsRequest('fakeuser');
        $getLatestTweets = new GetLatestTweetsService($this->tweetGetter);

        /** @var GetLatestTweetsResponse */
        $getLatestTweetsResponse = $getLatestTweets->execute($getLatestTweetsRequest);

        $this->assertEmpty($getLatestTweetsResponse->tweets());
    }

    /**
     * @test
     */
    public function requestExistingUserTweetsMustReturnANonEmptyResponse()
    {
        $getLatestTweetsRequest = new GetLatestTweetsRequest('existinguser');
        $getLatestTweets = new GetLatestTweetsService($this->tweetGetter);

        /** @var GetLatestTweetsResponse */
        $getLatestTweetsResponse = $getLatestTweets->execute($getLatestTweetsRequest);

        $this->assertNotEmpty($getLatestTweetsResponse->tweets());
    }
}
