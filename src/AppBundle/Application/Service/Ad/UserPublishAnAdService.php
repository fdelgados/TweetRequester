<?php

namespace AppBundle\Application\Service\Ad;

use AppBundle\Application\Service\ApplicationService;
use AppBundle\Application\Service\ApplicationServiceRequest;
use AppBundle\Application\Service\ApplicationServiceResponse;
use AppBundle\Domain\Model\Ad\Ad;
use AppBundle\Domain\Model\Ad\AdDescription;
use AppBundle\Domain\Model\Ad\AdRepository;
use AppBundle\Domain\Model\Ad\AdTitle;

class UserPublishAnAdService implements ApplicationService
{
    /** @var AdRepository */
    private $adRepository;

    public function __construct(AdRepository $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    /**
     * @param AdPublishingRequest|ApplicationServiceRequest $request
     * @return UserPublishAnAdResponse|ApplicationServiceResponse
     */
    public function execute(ApplicationServiceRequest $request)
    {
        $newAd = $this->createAd($request);

        $isAdSaved = $this->adRepository->save($newAd);
        if ($isAdSaved) {
            return new UserPublishAnAdResponse(
                $isAdSaved,
                'Ad published OK',
                $newAd->id(),
                $newAd->title(),
                $newAd->description()
            );
        }

        return new UserPublishAnAdResponse(
            $isAdSaved,
            'Error'
        );
    }

    /**
     * @param AdPublishingRequest|ApplicationServiceRequest $request
     * @return Ad
     * @throws \Exception
     */
    private function createAd(ApplicationServiceRequest $request)
    {
        try {
            $newAd = new Ad(
                $this->adRepository->nextIdentity(),
                new AdTitle($request->title()),
                new AdDescription($request->description()),
                new \DateTimeImmutable()
            );
            return $newAd;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
