<?php

namespace Sfynx\DddBundle\Layer\Presentation\Adapter\Generalisation;

use Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\QueryRequestInterface;

abstract class AbstractGetByIdsQueryAdapter
{
    protected $queryNamespace;

    public function createQueryFromRequest(QueryRequestInterface $request)
    {
        $parameters = $request->getRequestParameters();

        $entityIds = explode(',', $parameters['entityIds']);//if only 1 => array with 1

        return new $this->queryNamespace($entityIds);
    }
}
