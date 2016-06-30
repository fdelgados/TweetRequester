<?php

namespace AppBundle\Domain\Model\Ad;

interface AdRepository
{
    /**
     * @return TweetId
     */
    public function nextIdentity();

    /**
     * @param TweetId $id
     * 
*@return Ad
     */
    public function adOfId(TweetId $id);

    /**
     * @param Ad $anAd
     * @return bool
     */
    public function save(Ad $anAd);
}