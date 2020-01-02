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
     * @param T $entity
     */
    final public function persist($entity): void
    {
        $manager = $this->getObjectManager();
        $manager->persist($entity);
        $manager->flush();
    }

    /**
     * @param T $entity
     */
    protected function delete($entity): void
    {
        $manager = $this->getObjectManager();
        $manager->remove($entity);
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
