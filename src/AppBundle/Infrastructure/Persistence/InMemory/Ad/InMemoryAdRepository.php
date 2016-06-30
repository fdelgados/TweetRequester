<?php

namespace AppBundle\Infrastructure\Persistence\InMemory\Ad;

use AppBundle\Domain\Model\Ad\TweetId;
use AppBundle\Domain\Model\Ad\Ad;
use AppBundle\Domain\Model\Ad\AdRepository;

class InMemoryAdRepository implements AdRepository
{
    private $ads = [];
    
    public function nextIdentity()
    {
        return TweetId::create();
    }

    public function adOfId(TweetId $id)
    {
        if (isset($this->ads[(string) $id])) {
            return $this->ads[(string) $id];
        }
        return null;
    }

    public function save(Ad $anAd)
    {
        return $this->ads[(string) $anAd->id()] = $anAd;
    }
}
