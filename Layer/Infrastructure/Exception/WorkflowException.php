<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Exception;

class WorkflowException extends \Exception
{
    /**
     * Returns the <No Created Entity> Exception.
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function NoCreatedEntity()
    {
        return new self(sprintf('Entity has not been created'));
    }
}
