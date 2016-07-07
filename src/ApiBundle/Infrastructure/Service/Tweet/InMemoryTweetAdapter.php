<?php

namespace ApiBundle\Infrastructure\Service\Tweet;

use ApiBundle\Domain\Model\Tweet\TweetAdapter;

class InMemoryTweetAdapter implements TweetAdapter
{
    private $tweets = [];

    public function __construct()
    {
        for ($tweetIndex = 0; $tweetIndex < 10; $tweetIndex++) {
            $this->insertTweet('existinguser', $tweetIndex);
        }
    }

    public function transformToTweets($username)
    {
        if (isset($this->tweets[$username])) {
            return $this->tweets[$username];
        }
        return [];
    }

    private function insertTweet($username, $index)
    {
        $tweet = new \stdClass();
        $tweet->id_str = strval(10001 + $index);
        $tweet->text = $this->generateRandomString();
        $tweet->created_at = new \DateTime();
        $this->tweets[$username][$index] = $tweet;
    }

    /**
     * Shamelessly stolen from stackoverflow ;)
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 140) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
