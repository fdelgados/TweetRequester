<?php

namespace AppBundle\Infrastructure\Persistence\Doctrine\Ad;

use AppBundle\Domain\Model\Ad\AdId;
use AppBundle\Domain\Model\Ad\Ad;
use AppBundle\Domain\Model\Ad\AdRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineAdRepository extends EntityRepository implements AdRepository
{
    /**
     * @inheritdoc
     */
    public function nextIdentity()
    {
        return AdId::create();
    }

    /**
     * @inheritdoc
     */
    public function adOfId(AdId $id)
    {
        return $this->find($id);
    }

    public function save(Ad $anAd)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($anAd);
        $entityManager->flush();
    }
}
