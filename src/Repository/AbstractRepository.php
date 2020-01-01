<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @template T
 */
abstract class AbstractRepository
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
     * @return T[]
     */
    final public function findAll(): iterable
    {
        $classType = $this->getClassType();

        return $this->entityManager->getRepository($classType)->findAll();
    }

    /**
     * @param T $event
     */
    final public function persist($event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @return class-string<T> string
     */
    abstract protected function getClassType(): string;
}
