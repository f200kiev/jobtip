<?php

namespace AppBundle\Controller;

use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Repository\CompaniesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class PositionsController extends Controller
{
    private $companiesRepository;

    private $serializer;

    public function __construct(
        CompaniesRepository $companiesRepository,
        Serializer $serializer
    ) {
        $this->companiesRepository = $companiesRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/reference", name="homepage")
     */
    public function getReferenceAction(): JsonResponse
    {
        $companiesResult = $this->companiesRepository->findAllPositions();

        return new JsonResponse(json_decode($this->serializer->serialize($companiesResult, 'json')));
    }
}
