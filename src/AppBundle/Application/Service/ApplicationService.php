<?php

namespace AppBundle\Application\Service;

interface ApplicationService
{
    /**
     * @param ApplicationServiceRequest $request
     * @return ApplicationServiceResponse
     */
    public function execute(ApplicationServiceRequest $request);
}
