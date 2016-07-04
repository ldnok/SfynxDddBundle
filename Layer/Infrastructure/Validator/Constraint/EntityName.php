<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EntityName extends Constraint
{
    protected $message = "The string %string% contains an illegal character: it can only contain letters.";

    protected $regex = '/^[[:alpha:]\s\'\x22\-_&@!?()\[\]-]*$/u';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    /**
     * @return string
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * @param string $regex
     */
    public function setRegex($regex)
    {
        $this->regex = $regex;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}
