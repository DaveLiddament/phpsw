<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class AbstractConstraint extends Constraint
{
    /** @var string */
    public $message = 'Invalid value';
}
