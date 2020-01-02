<?php

namespace App\Repository;

use App\Entity\Venue;
use Webmozart\Assert\Assert;

/**
 * @extends AbstractRepository<Venue>
 */
class VenueRepository extends AbstractRepository
{
    public function delete(Venue $venue): void
    {
        Assert::true($venue->canDelete());
        $this->getObjectManager()->remove($venue);
        $this->getObjectManager()->flush();
    }

    /**
     * @return Venue[]
     */
    public function findAll(): iterable
    {
        return $this->getRepository()->findBy([], ['name' => 'ASC']);
    }

    protected function getClassType(): string
    {
        return Venue::class;
    }
}
