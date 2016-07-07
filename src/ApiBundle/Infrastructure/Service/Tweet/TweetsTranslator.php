<?php

namespace ApiBundle\Infrastructure\Service\Tweet;

use ApiBundle\Domain\Model\Tweet\Tweet;

class TweetsTranslator
{
    /**
     * @param $response
     * @return Tweet[]
     */
    public function translateFromApiResponse($response)
    {
        $tweets = [];
        foreach ($response as $tweet) {
            $tweets[] = new Tweet(
                $tweet->id_str,
                $tweet->text,
                new \DateTimeImmutable($tweet->created_at)
            );
        }

        return $tweets;
    }
}
