<?php

namespace Sfynx\DddBundle\Layer\Presentation\Adapter\Generalisation;

use Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\CommandRequestInterface;

abstract class AbstractDeleteManyCommandAdapter
{
    protected $commandNamespace;

    public function createCommandFromRequest(CommandRequestInterface $request)
    {
        $parameters = $request->getRequestParameters();
        $entityIds = $parameters['entityIds'];

        return new $this->commandNamespace($entityIds);
    }
}
