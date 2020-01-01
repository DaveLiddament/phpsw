<?php

namespace App\Repository;

use App\Entity\Venue;

/**
 * @extends AbstractRepository<Venue>
 */
class VenueRepository extends AbstractRepository
{
    protected function getClassType(): string
    {
        return Venue::class;
    }
}
