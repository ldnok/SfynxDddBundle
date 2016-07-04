<?php

namespace Sfynx\DddBundle\Layer\Presentation\Adapter\Generalisation;

use Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\QueryRequestInterface;

abstract class AbstractOneQueryAdapter
{
    protected $queryNamespace;

    public function createQueryFromRequest(QueryRequestInterface $request)
    {
        $parameters = $request->getRequestParameters();

        //exception si id manquant

        return new $this->queryNamespace($parameters['entityId']);
    }
}
