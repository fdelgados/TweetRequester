<?php

namespace Tests\ApiBundle\Controller;

use GuzzleHttp\Client;

class ApiRestControllerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Client */
    private $client;

    protected function setUp()
    {
        $this->client = new Client(
            [
                'base_uri' => 'http://vagrant.www.tweetrequester.dev'
            ]
        );
    }

    /**
     * @test
     */
    public function getRequestMustResponseWithAnOkStatusCode()
    {
        $response = $this->client->get('/app_dev.php/api/tweets/username');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function postRequestMustResponseWithAnOkStatusCode()
    {
        $response = $this->client->post(
            '/app_dev.php/api/tweets/username'
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function deleteRequestMustResponseWithMethodNotAllowedStatusCode()
    {
        $response = $this->client->delete(
            '/app_dev.php/api/tweets/username',
            [
                'http_errors' => false
            ]
        );

        $this->assertEquals(405, $response->getStatusCode());
    }
}
