<?php

namespace App\Repository;

use App\Entity\Person;

/**
 * @extends AbstractRepository<Person>
 */
class PersonRepository extends AbstractRepository
{
    protected function getClassType(): string
    {
        return Person::class;
    }
}
