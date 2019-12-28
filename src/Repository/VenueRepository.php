<?php

namespace App\Repository;

use App\Entity\Venue;
use Doctrine\ORM\EntityManagerInterface;

class VenueRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Venue[]
     */
    public function findAll(): iterable
    {
        return $this->entityManager->getRepository(Venue::class)->findAll();
    }

    public function persist(Venue $venue): void
    {
        $this->entityManager->persist($venue);
        $this->entityManager->flush();
    }
}
