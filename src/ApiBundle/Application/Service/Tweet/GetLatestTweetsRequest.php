<?php

namespace ApiBundle\Application\Service\Tweet;

use ApiBundle\Application\Service\ApplicationServiceRequest;

class GetLatestTweetsRequest implements ApplicationServiceRequest
{
    /** @var string */
    private $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function username()
    {
        return $this->username;
    }
}
