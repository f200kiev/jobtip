<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Controller\PositionsController;
use AppBundle\Repository\CompaniesRepository;
use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PositionsControllerTest extends WebTestCase
{
    /**
     * @var CompaniesRepository
     */
    private $companiesRepository;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var PositionsController
     */
    private $controllerService;

    public function setUp()
    {
        parent::setUp();
        $this->companiesRepository = $this->prophesize(CompaniesRepository::class);
        $this->serializer = $this->prophesize(Serializer::class);

        $this->controllerService = new PositionsController(
            $this->companiesRepository->reveal(),
            $this->serializer->reveal()
        );
    }

    public function tearDown()
    {
        unset($this->companiesRepository, $this->serializer, $this->controllerService);
    }

    public function testShouldCallRepositoryWhenCallGetAction()
    {
        // given
        $this->companiesRepository
            ->findAllPositions()
            ->shouldBeCalledTimes(1);

        // when
        $response = $this->controllerService->getReferenceAction();

        //then
        $this->assertEquals('application/json', $response->headers->get('Content-type'));
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
