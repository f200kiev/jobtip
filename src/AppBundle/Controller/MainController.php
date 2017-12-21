<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Companies;
use AppBundle\Entity\Positions;
use AppBundle\Form\CompaniesFormType;
use AppBundle\Form\PositionsFormType;
use AppBundle\Persister\CompaniesEntityPersister;
use AppBundle\Persister\PositionsEntityPersister;
use AppBundle\Repository\CompaniesRepository;
use AppBundle\Repository\PositionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    private $positionsEntityPersister;

    private $companiesEntityPersister;

    private $positionsRepository;

    private $companiesRepository;

    public function __construct(
        PositionsEntityPersister $positionsEntityPersister,
        CompaniesEntityPersister $companiesEntityPersister,
        PositionsRepository $positionsRepository,
        CompaniesRepository $companiesRepository
    ) {
        $this->positionsEntityPersister = $positionsEntityPersister;
        $this->companiesEntityPersister = $companiesEntityPersister;
        $this->positionsRepository = $positionsRepository;
        $this->companiesRepository = $companiesRepository;
    }

    /**
     * @Route("/", name="homepage")
     *
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/add_position", name="add_position")
     *
     * @param Request $request
     * @return Response
     */
    public function newPositionAction(Request $request)
    {
        $positionEntity = new Positions();

        $form = $this->createForm(PositionsFormType::class, $positionEntity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPosition = $form->getData();

            $this->positionsEntityPersister->save($newPosition);
            return $this->redirect('/reference/' . $newPosition->getId());
        }

        return $this->render('default/add.position.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/add_company", name="add_company")
     *
     * @param Request $request
     * @return Response
     */
    public function newCompanyAction(Request $request)
    {
        $companyEntity = new Companies();

        $form = $this->createForm(CompaniesFormType::class, $companyEntity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newCompany = $form->getData();

            $this->companiesEntityPersister->save($newCompany);
            return $this->redirect('/company/' . $newCompany->getId());
        }

        return $this->render('default/add.company.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/reference/{positionId}", name="position")
     */
    public function getReferenceAction($positionId)
    {
        $position = $this->positionsRepository->findPositions($positionId);

        return $this->render('default/view.positions.html.twig', array(
            'position' => array_shift($position),
        ));
    }

    /**
     * @Route("/reference", name="positions_list")
     */
    public function getAllReferenceAction()
    {
        $positions = $this->positionsRepository->findAllPositions();

        return $this->render('default/view.all.positions.html.twig', array(
            'positions' => $positions
        ));
    }

    /**
     * @Route("/companies/{companyId}", name="company")
     */
    public function getCompaniesAction($companyId)
    {
        $company = $this->companiesRepository->findCompanies($companyId);

        return $this->render('default/view.company.html.twig', array(
            'company' => array_shift($company),
        ));
    }

    /**
     * @Route("/companies", name="companies_list")
     */
    public function getAllCompaniesAction()
    {
        $companies = $this->companiesRepository->findAllCompanies();
        return $this->render('default/view.all.companies.html.twig', array(
            'companies' => $companies,
        ));
    }
}
