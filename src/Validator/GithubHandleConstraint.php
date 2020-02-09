<?php

declare(strict_types=1);

namespace App\Validator;

class GithubHandleConstraint extends AbstractConstraint
{
    /** @var string */
    public $message = 'Github handle contains invalid characters';
}
