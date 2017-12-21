<?php

namespace AppBundle\Persister;

use AppBundle\Entity\Companies;
use Doctrine\ORM\EntityManagerInterface;

class CompaniesEntityPersister
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Companies $entity): Companies
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }
}
