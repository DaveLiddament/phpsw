<?php

declare(strict_types=1);

namespace App\Validator;

/** @extends AbstractConstraintValidator<GithubHandleConstraint> */
class GithubHandleConstraintValidator extends AbstractConstraintValidator
{
    protected function getConstraintType(): string
    {
        return GithubHandleConstraint::class;
    }

    protected function getRegEx(): string
    {
        return '/^[a-z\d](?:[a-z\d]|-(?=[a-z\d])){0,38}$/i';
    }
}
