<?php

namespace Sfynx\DddBundle\Layer\Domain\Workflow\Generalisation;

use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;

interface WorkflowHandlerInterface
{
    public function process(CommandInterface $command);
}
