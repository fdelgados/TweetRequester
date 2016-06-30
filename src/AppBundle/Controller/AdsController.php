<?php

namespace AppBundle\Controller;

use AppBundle\Application\Service\Ad\AdPublishingRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdsController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function publishAdAction(Request $request)
    {

        $userPublishAnAdService = $this->get("api.application.service.ad.user_publish_an_ad");
        $adPublishingRequest = new AdPublishingRequest(
            'Ad title',
            'Ad description'
        );
        $userPublishAnAdService->execute($adPublishingRequest);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
