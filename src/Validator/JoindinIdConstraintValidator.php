<?php

declare(strict_types=1);

namespace App\Validator;

/** @extends AbstractConstraintValidator<JoindinIdConstraint> */
class JoindinIdConstraintValidator extends AbstractConstraintValidator
{
    protected function getConstraintType(): string
    {
        return JoindinIdConstraint::class;
    }

    protected function getRegEx(): string
    {
        return '/^[0-9a-z]{1,15}$/i';
    }
}
