<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @template T
 */
abstract class AbstractRepository
{
    /**
     * @var ManagerRegistry
     */
    private $entityManager;

    public function __construct(ManagerRegistry $entityManager)
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
        $manager = $this->entityManager->getManager();
        $manager->persist($event);
        $manager->flush();
    }

    protected function getEntityManager(): ManagerRegistry
    {
        return $this->entityManager;
    }

    /**
     * @return class-string<T> string
     */
    abstract protected function getClassType(): string;
}
