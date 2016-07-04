<?php

namespace Sfynx\DddBundle\Layer\Presentation\Response\Generalisation;

interface ResponseHandlerInterface
{
    public function create($data = null, $statusCode = null, array $headers = array());

    public function getResponse();
}