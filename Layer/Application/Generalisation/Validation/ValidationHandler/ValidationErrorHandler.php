<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Validation\ValidationHandler;

class ValidationErrorHandler
{
    /**
     * @param array $errors output of validator->validateValue() method
     * @return array
     */
    public static function arrayAll(\IteratorAggregate $errors)
    {
        $tab = [];
        foreach ($errors as $error) {
            $field = substr($error->getPropertyPath(), 1, -1);
            $tab[$field] = $error->getMessage();
        }
        return $tab;
    }
}
