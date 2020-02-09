<?php

declare(strict_types=1);

namespace App\Validator;

class TwitterHandleConstraint extends AbstractConstraint
{
    /** @var string */
    public $message = 'Twitter handle contains invalid characters';
}
