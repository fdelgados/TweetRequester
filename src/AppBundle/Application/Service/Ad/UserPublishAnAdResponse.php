<?php

namespace AppBundle\Application\Service\Ad;

use AppBundle\Application\Service\ApplicationServiceResponse;
use AppBundle\Domain\Model\Ad\AdDescription;
use AppBundle\Domain\Model\Ad\TweetId;
use AppBundle\Domain\Model\Ad\AdTitle;

class UserPublishAnAdResponse implements ApplicationServiceResponse
{
    /** @var bool */
    private $success;

    /** @var string */
    private $message;

    /** @var TweetId */
    private $adId;

    /** @var string */
    private $adTitle;

    /** @var string */
    private $adDescription;

    public function __construct(
        $success,
        $message,
        TweetId $adId = null,
        AdTitle $adTitle = null,
        AdDescription $adDescription = null
    ) {
        $this->success = $success;
        $this->message = $message;
        $this->adId = $adId;
        $this->adTitle = $adTitle;
        $this->adDescription = $adDescription;
    }

    /**
     * @return TweetId
     */
    public function adId()
    {
        return $this->adId;
    }

    /**
     * @return bool
     */
    public function success()
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getAdTitle()
    {
        return $this->adTitle;
    }

    /**
     * @return string
     */
    public function getAdDescription()
    {
        return $this->adDescription;
    }
}
