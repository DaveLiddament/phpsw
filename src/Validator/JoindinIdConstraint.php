<?php

declare(strict_types=1);

namespace App\Validator;

/**
 * @Annotation
 */
class JoindinIdConstraint extends AbstractConstraint
{
    /** @var string */
    public $message = 'Joindin ID should be the the alphanumeric short code';
}
