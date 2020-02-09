<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @template T of AbstractConstraint
 */
abstract class AbstractConstraintValidator extends ConstraintValidator
{
    /** @param mixed $value */
    final public function validate($value, Constraint $constraint): void
    {
        $constraintType = $this->getConstraintType();
        if (!$constraint instanceof $constraintType) {
            throw new UnexpectedTypeException($constraint, $constraintType);
        }

        if ((null === $value) || ('' === $value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (!preg_match($this->getRegEx(), $value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }

    /**
     * @phpstan-return class-string<T>
     */
    abstract protected function getConstraintType(): string;

    abstract protected function getRegEx(): string;
}
