<?php

declare(strict_types=1);

namespace App\Validator;

/** @extends AbstractConstraintValidator<TwitterHandleConstraint> */
class TwitterHandleConstraintValidator extends AbstractConstraintValidator
{
    protected function getConstraintType(): string
    {
        return TwitterHandleConstraint::class;
    }

    protected function getRegEx(): string
    {
        return '/^[A-Za-z0-9_]{1,15}$/';
    }
}
