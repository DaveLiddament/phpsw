<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class TwitterHandleConstraint extends Constraint
{
    /** @var string */
    public $message = 'Twitter handle contains invalid characters';
}
