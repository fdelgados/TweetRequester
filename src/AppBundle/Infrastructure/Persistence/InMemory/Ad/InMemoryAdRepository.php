<?php

namespace AppBundle\Infrastructure\Persistence\InMemory\Ad;

use AppBundle\Domain\Model\Ad\AdId;
use AppBundle\Domain\Model\Ad\Ad;
use AppBundle\Domain\Model\Ad\AdRepository;

class InMemoryAdRepository implements AdRepository
{
    private $ads = [];
    
    public function nextIdentity()
    {
        return AdId::create();
    }

    public function adOfId(AdId $id)
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
