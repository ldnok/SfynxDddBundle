<?php

namespace Sfynx\DddBundle\Layer\Presentation\Adapter\Generalisation;

use Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\CommandRequestInterface;

abstract class AbstractDeleteCommandAdapter
{
    protected $commandNamespace;

    public function createCommandFromRequest(CommandRequestInterface $request)
    {
        $parameters = $request->getRequestParameters();
        $entityId = $parameters['entityId'];
        $rev = $parameters['revision'];

        return new $this->commandNamespace($entityId, $rev);
    }
}
