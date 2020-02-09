<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TwitterHandleConstraintValidator extends ConstraintValidator
{
    /** @param mixed $value */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof TwitterHandleConstraint) {
            throw new UnexpectedTypeException($constraint, TwitterHandleConstraint::class);
        }

        if ((null === $value) || ('' === $value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (!preg_match('/^[A-Za-z0-9_]{1,15}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
