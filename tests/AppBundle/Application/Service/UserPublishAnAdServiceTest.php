<?php

namespace Tests\AppBundle\Application\Service;

use AppBundle\Application\Service\Ad\UserPublishAnAdService;
use AppBundle\Application\Service\Ad\AdPublishingRequest;
use AppBundle\Infrastructure\Persistence\InMemory\Ad\InMemoryAdRepository;

class UserPublishAnAdServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserPublishAnAdService */
    private $userPublishAnAdService;

    /** @var InMemoryAdRepository */
    private $adRepository;

    public function setUp()
    {
        $this->adRepository = new InMemoryAdRepository();
        $this->userPublishAnAdService = new UserPublishAnAdService($this->adRepository);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function emptyAdTitleMustThrowAnException()
    {
        $adPublishingRequest = new AdPublishingRequest(
            '',
            'Ad description'
        );

        $this->userPublishAnAdService->execute($adPublishingRequest);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function adTitleTooShortMustThrowAnException()
    {
        $adPublishingRequest = new AdPublishingRequest(
            'Ad',
            'Ad description'
        );

        $this->userPublishAnAdService->execute($adPublishingRequest);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function adTitleTooLongtMustThrowAnException()
    {
        $adPublishingRequest = new AdPublishingRequest(
            file_get_contents(__DIR__ . '/Fixture/TooLongDummyText.txt'),
            'Ad description'
        );

        $this->userPublishAnAdService->execute($adPublishingRequest);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function emptyAdDescriptionMustThrowAnException()
    {
        $adPublishingRequest = new AdPublishingRequest(
            'Ad title',
            ''
        );

        $this->userPublishAnAdService->execute($adPublishingRequest);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function adDescriptionTooShortMustThrowAnException()
    {
        $adPublishingRequest = new AdPublishingRequest(
            'Ad title',
            'Ad desc'
        );

        $this->userPublishAnAdService->execute($adPublishingRequest);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function adDescriptionTooLongtMustThrowAnException()
    {
        $adPublishingRequest = new AdPublishingRequest(
            'Ad title',
            file_get_contents(__DIR__ . '/Fixture/TooLongDummyText.txt')
        );

        $this->userPublishAnAdService->execute($adPublishingRequest);
    }

    /**
     * @test
     */
    public function afterPublishingAdMustBeInTheRepository()
    {
        $adPublishingRequest = new AdPublishingRequest(
            'Ad title',
            'Ad description'
        );

        $adPublishingResponse = $this->userPublishAnAdService->execute($adPublishingRequest);
        $newAd = $this->adRepository->adOfId($adPublishingResponse->adId());

        $this->assertNotNull($newAd);
    }
}
