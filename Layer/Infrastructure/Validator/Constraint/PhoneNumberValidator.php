<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Validator\Constraint;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class PhoneNumberValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match($constraint->getRegex(), $value)) {
            $this->context->buildViolation($constraint->getMessage())
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
