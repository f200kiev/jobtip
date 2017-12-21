<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Positions;
use AppBundle\Persister\PositionsEntityPersister;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Repository\CompaniesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PositionsController extends Controller
{
    private $positionsEntityPersister;

    private $companiesRepository;

    private $serializer;

    private $validator;

    public function __construct(
        PositionsEntityPersister $positionsEntityPersister,
        CompaniesRepository $companiesRepository,
        Serializer $serializer,
        ValidatorInterface $validator
    ) {
        $this->positionsEntityPersister = $positionsEntityPersister;
        $this->companiesRepository = $companiesRepository;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @Route("/add_position", name="addPosition")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addPositionAction(Request $request): JsonResponse
    {
        $positionEntity = $this->serializer->deserialize($request->getContent(), Positions::class, 'json');

        $violations = $this->validator->validate($positionEntity);

        if (0 !== count($violations)) {
            return $this->createValidationErrorResponse($violations);
        }

        $this->positionsEntityPersister->save($positionEntity);

        return new JsonResponse(json_decode($this->serializer->serialize($positionEntity, 'json')));
    }
    /**
     * @Route("/reference", name="homepage")
     */
    public function getReferenceAction(): JsonResponse
    {
        $companiesResult = $this->companiesRepository->findAllPositions();

        return new JsonResponse(json_decode($this->serializer->serialize($companiesResult, 'json')));
    }

    private function createValidationErrorResponse(ConstraintViolationListInterface $violationlist): JsonResponse
    {
        $errorList = null;

        foreach ($violationlist as $error) {
            $errorList[$error->getPropertyPath()] = $error->getMessageTemplate();
        }

        $data = ['status' => 'error', 'errors' => $errorList];

        return $this->createBadRequestResponse($data);
    }

    private function createBadRequestResponse($data = null): JsonResponse
    {
        return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
    }
}
