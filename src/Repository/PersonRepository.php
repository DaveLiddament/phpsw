<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

class PersonRepository
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
     * @return Person[]
     */
    public function findAll(): iterable
    {
        return $this->entityManager->getRepository(Person::class)->findAll();
    }

    public function persist(Person $person): void
    {
        $this->entityManager->persist($person);
        $this->entityManager->flush();
    }
}
