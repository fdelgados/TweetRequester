<?php

namespace ApiBundle\Infrastructure\Service;

use ApiBundle\Domain\Model\Tweet\TweetAdapter;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class HttpTweetAdapter implements TweetAdapter
{
    /** @var Client */
    private $client;

    /** @var Oauth1 */
    private $oauth;

    public function __construct(Client $client, Oauth1 $oauth)
    {
        $this->client = $client;
        $this->oauth = $oauth;
    }

    public function transformToTweets($username)
    {
        if (200 === $this->client->get()) {

        }
    }
}
