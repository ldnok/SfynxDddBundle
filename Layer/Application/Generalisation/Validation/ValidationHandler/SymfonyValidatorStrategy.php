<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Validation\ValidationHandler;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidatorInterface;

class SymfonyValidatorStrategy implements ValidatorInterface
{
    /**
     * @var SymfonyValidatorInterface
     */
    protected $validator;

    public function __construct(SymfonyValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $data
     * @param array $constraints must be like [field_name => constraints, field_name => constraints, field_name => constraints]
     */
    public function validateValue($data, array $constraints)
    {
        return $this->validator->validateValue($data, new Collection($constraints));
    }
}
