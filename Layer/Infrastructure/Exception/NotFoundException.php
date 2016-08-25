<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Exception;

use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends \Exception
{
    public function construct($message = "", Exception $previous = null)
    {
        parent::__construct($message, Response::HTTP_NOT_FOUND, $previous);
    }
}
