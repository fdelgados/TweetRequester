<?php

namespace ApiBundle\Application\Service\Tweet;

use ApiBundle\Application\Service\ApplicationService;
use ApiBundle\Application\Service\ApplicationServiceRequest;
use ApiBundle\Domain\Model\Tweet\Tweet;
use ApiBundle\Domain\Service\Tweet\TweetGetter;

class GetLatestTweetsService implements ApplicationService
{
    /** @var TweetGetter */
    private $tweetGetter;

    public function __construct(TweetGetter $tweetService)
    {
        $this->tweetGetter = $tweetService;
    }

    /**
     * @param GetLatestTweetsRequest|ApplicationServiceRequest $request
     * @return GetLatestTweetsResponse
     */
    public function execute(ApplicationServiceRequest $request)
    {
        $username = $request->username();

        try {
            $tweets = array_map(function (Tweet $tweet) {
                return [
                    'id' => $tweet->id(),
                    'text' => $tweet->text(),
                    'created_at' => $tweet->createdAt()->format('d-m-Y H:i')
                ];
            }, $this->tweetGetter->latestFromUser($username));
        } catch (\Exception $e) {
            return new GetLatestTweetsResponse(false, $username, [], $e->getMessage());
        }

        return new GetLatestTweetsResponse(true, $username, $tweets);
    }
}
