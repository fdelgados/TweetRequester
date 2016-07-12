<?php

namespace ApiBundle\Application\Service\Tweet;

use ApiBundle\Application\Service\ApplicationServiceResponse;

class GetLatestTweetsResponse implements ApplicationServiceResponse
{
    /** @var bool */
    private $success;

    /** @var string */
    private $username;

    /** @var array */
    private $tweets = [];

    /** @var string */
    private $message;

    public function __construct($success, $username, $tweets, $message = '')
    {
        $this->success = $success;
        $this->username = $username;
        $this->tweets = $tweets;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * @return array
     */
    public function tweets()
    {
        return $this->tweets;
    }

    /**
     * @return boolean
     */
    public function success()
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
