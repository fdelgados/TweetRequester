<?php

namespace ApiBundle\Infrastructure\Service\Tweet;

use ApiBundle\Domain\Model\Tweet\Tweet;
use ApiBundle\Domain\Model\Tweet\TweetAdapter;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class HttpTweetAdapter implements TweetAdapter
{
    /** @var Client */
    private $client;

    /** @var Oauth1 */
    private $oauth;

    /** @var HandlerStack */
    private $stack;

    public function __construct(Client $client, Oauth1 $oauth)
    {
        $this->client = $client;
        $this->oauth = $oauth;
        $this->stack = HandlerStack::create();
    }

    /**
     * @param string $username
     * @return Tweet[]
     */
    public function transformToTweets($username)
    {
        $this->stack->push($this->oauth, 'Oauth');
        $options = [
            'auth' => 'oauth',
            'handler' => $this->stack,
            'query' => [
                'screen_name' => $username
            ]
        ];

        $tweets = [];

        try {
            $response = $this->client->request('GET', '/1.1/statuses/user_timeline.json', $options);

            if (200 === $response->getStatusCode()) {
                $tweetTranslator = new TweetsTranslator();

                $tweets = $tweetTranslator->translateFromApiResponse(
                    json_decode($response->getBody()->getContents())
                );
            }
            
            return $tweets;
        } catch (\Exception $e) {
            return [];
        } finally {
            return $tweets;
        }
    }
}
