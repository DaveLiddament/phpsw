<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

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
     * @param T $event
     */
    final public function persist($event): void
    {
        $manager = $this->getObjectManager();
        $manager->persist($event);
        $manager->flush();
    }

    protected function getObjectManager(): ObjectManager
    {
        return $this->entityManager->getManager();
    }

    /**
     * @return ObjectRepository<T>
     */
    protected function getRepository(): ObjectRepository
    {
        $classType = $this->getClassType();

        return $this->entityManager->getRepository($classType);
    }

    /**
     * @return class-string<T> string
     */
    abstract protected function getClassType(): string;
}
