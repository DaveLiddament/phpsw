<?php

namespace App\Repository;

use App\Entity\Event;

/**
 * @extends AbstractRepository<Event>
 */
class EventRepository extends AbstractRepository
{
    protected function getClassType(): string
    {
        return Event::class;
    }
}
