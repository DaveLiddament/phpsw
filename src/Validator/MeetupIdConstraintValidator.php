<?php

declare(strict_types=1);

namespace App\Validator;

/** @extends AbstractConstraintValidator<MeetupIdConstraint> */
class MeetupIdConstraintValidator extends AbstractConstraintValidator
{
    protected function getConstraintType(): string
    {
        return MeetupIdConstraint::class;
    }

    protected function getRegEx(): string
    {
        return '/^[0-9]{1,15}$/';
    }
}
