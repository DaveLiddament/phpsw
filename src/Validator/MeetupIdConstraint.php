<?php

declare(strict_types=1);

namespace App\Validator;

/**
 * @Annotation
 */
class MeetupIdConstraint extends AbstractConstraint
{
    /** @var string */
    public $message = 'MeetupId should only contain digits';
}
