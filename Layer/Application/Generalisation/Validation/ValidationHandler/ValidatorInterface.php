<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Validation\ValidationHandler;

interface ValidatorInterface
{
    public function validateValue($data, array $constraints);
}
