<?php

namespace App\Repository;

use App\Entity\Sponsor;

/**
 * @extends AbstractRepository<Sponsor>
 */
class SponsorRepository extends AbstractRepository
{
    protected function getClassType(): string
    {
        return Sponsor::class;
    }
}
