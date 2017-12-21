<?php

namespace AppBundle\Persister;

use AppBundle\Entity\Positions;
use Doctrine\ORM\EntityManagerInterface;

class PositionsEntityPersister
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Positions $entity): Positions
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }
}
