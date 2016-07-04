<?php

namespace Sfynx\DddBundle\Layer\Presentation\Adapter\Generalisation;

use Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\CommandRequestInterface;

/**
 * Interface CommandAdapterInterface
 * @package Sfynx\DddBundle\Layer\Presentation\Adapter\Generalisation
 */
interface CommandAdapterInterface
{
    /**
     * @param CommandRequestInterface $request
     * @return mixed
     */
    public function createCommandFromRequest(CommandRequestInterface $request);
}