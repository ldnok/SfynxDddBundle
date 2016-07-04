<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Validation\ValidationHandler;

use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\CommandValidationHandlerInterface;
use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;

abstract class AbstractCommandValidationHandler implements CommandValidationHandlerInterface
{
    protected $validator;

    protected $constraints;

    protected $errors;

    public function __construct(ValidatorInterface $validator) {
        $this->constraints = [];
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function process(CommandInterface $command)
    {
        $this->initConstraints();
        $this->errors = $this->validator->validateValue($command->toArray(true), $this->getConstraints());
        if (count($this->errors) === 0) {
            return true;
        }

        throw new \Exception(serialize($this->getErrors())) ;
    }

    public function getErrors()
    {
        return ValidationErrorHandler::arrayAll($this->errors);
    }

    /**
     * @return array of constraints [field_name => constraints, field_name => constraints, ...]
     */
    abstract protected function initConstraints();

    /**
     * @param $field
     * @param $constraints
     */
    protected function add($field, $constraints)
    {
        $this->constraints[$field] = $constraints;
        return $this;
    }

    protected function getConstraints()
    {
        return $this->constraints;
    }
}
