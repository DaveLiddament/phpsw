<?php

namespace App\Repository;

use App\Entity\Talk;
use Doctrine\ORM\EntityManagerInterface;

class TalkRepository
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
     * @return Talk[]
     */
    public function findAll(): iterable
    {
        return $this->entityManager->getRepository(Talk::class)->findAll();
    }

    public function persist(Talk $talk): void
    {
        $this->entityManager->persist($talk);
        $this->entityManager->flush();
    }
}
