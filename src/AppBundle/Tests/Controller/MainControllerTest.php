<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Controller\MainController;
use AppBundle\Persister\CompaniesEntityPersister;
use AppBundle\Persister\PositionsEntityPersister;
use AppBundle\Repository\CompaniesRepository;
use AppBundle\Repository\PositionsRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MainControllerTest extends WebTestCase
{
    /**
     * @var PositionsEntityPersister
     */
    private $positionsEntityPersister;

    /**
     * @var CompaniesEntityPersister
     */
    private $companiesEntityPersister;

    /**
     * @var PositionsRepository
     */
    private $positionsRepository;

    /**
     * @var CompaniesRepository
     */
    private $companiesRepository;

    /**
     * @var MainController
     */
    private $mainControllerService;

    public function setUp()
    {
        parent::setUp();
        $this->positionsEntityPersister = $this->prophesize(PositionsEntityPersister::class);
        $this->companiesEntityPersister = $this->prophesize(CompaniesEntityPersister::class);
        $this->positionsRepository = $this->prophesize(PositionsRepository::class);
        $this->companiesRepository = $this->prophesize(CompaniesRepository::class);

        $this->mainControllerService = new MainController(
            $this->positionsEntityPersister->reveal(),
            $this->companiesEntityPersister->reveal(),
            $this->positionsRepository->reveal(),
            $this->companiesRepository->reveal()

        );
    }

    public function tearDown()
    {
        unset(
            $this->companiesRepository,
            $this->mainControllerService,
            $this->positionsRepository,
            $this->positionsEntityPersister,
            $this->companiesEntityPersister
        );
    }

    public function testShouldCallGetAllReferenceAction()
    {
        // given
        $this->positionsRepository
            ->findAllPositions()
            ->shouldBeCalled(1);

        // when
        $response = $this->mainControllerService->getAllReferenceAction();

        // then
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testShouldCallGetCompanyAction()
    {
        // given
        $this->companiesRepository
            ->findCompanies('CompanyId')
            ->shouldBeCalled(1);

        // when
        $response = $this->mainControllerService->getCompaniesAction('CompanyId');

        // then
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
