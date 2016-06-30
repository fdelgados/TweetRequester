<?php

namespace AppBundle\Domain\Model\Ad;

interface AdRepository
{
    /**
     * @return AdId
     */
    public function nextIdentity();

    /**
     * @param AdId $id
     * @return Ad
     */
    public function adOfId(AdId $id);

    /**
     * @param Ad $anAd
     * @return bool
     */
    public function save(Ad $anAd);
}