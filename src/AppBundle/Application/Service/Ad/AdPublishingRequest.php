<?php

namespace AppBundle\Application\Service\Ad;

use AppBundle\Application\Service\ApplicationServiceRequest;

class AdPublishingRequest implements ApplicationServiceRequest
{
    /** @var string */
    private $title;

    /** @var string */
    private $description;

    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }
}
