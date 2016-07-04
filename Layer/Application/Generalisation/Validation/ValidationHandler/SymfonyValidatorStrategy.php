<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Validation\ValidationHandler;

use Symfony\Component\Validator\Constraints\Collection;

class SymfonyValidatorStrategy implements ValidatorInterface
{
    protected $validator;

    public function __construct($validator)
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
