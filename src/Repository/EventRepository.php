<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;

class EventRepository
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
     * @return Event[]
     */
    public function findAll(): iterable
    {
        return $this->entityManager->getRepository(Event::class)->findAll();
    }

    public function persist(Event $event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }
}
