<?php

namespace ApiBundle\Controller;

use ApiBundle\Application\Service\Tweet\GetLatestTweetsRequest;
use ApiBundle\Application\Service\Tweet\GetLatestTweetsResponse;
use ApiBundle\Application\Service\Tweet\GetLatestTweetsService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\FOSRestController;

class ApiRestController extends FOSRestController
{
    public function indexAction(Request $request)
    {

    }

    public function getTweetsAction($username)
    {
        /** @var GetLatestTweetsRequest */
        $getLatestTweetsRequest = new GetLatestTweetsRequest($username);

        /** @var GetLatestTweetsService */
        $getLatestTweetsService = $this->get('tweet_requester_api.get_latest_tweets_service');

        /** @var  GetLatestTweetsResponse */
        $getLatestTweetsResponse = $getLatestTweetsService->execute($getLatestTweetsRequest);

        if ($getLatestTweetsResponse->success()) {
            return new JsonResponse($getLatestTweetsResponse->tweets());
        }
        
        return new JsonResponse($getLatestTweetsResponse->message());
    }
}
