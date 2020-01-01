<?php

namespace App\Repository;

use App\Entity\Talk;

/**
 * @extends AbstractRepository<Talk>
 */
class TalkRepository extends AbstractRepository
{
    protected function getClassType(): string
    {
        return Talk::class;
    }
}
