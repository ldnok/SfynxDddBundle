<?php

namespace Sfynx\DddBundle\Layer\Presentation\Adapter\Generalisation;

use Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\QueryRequestInterface;

/**
 * Interface QueryAdapterInterface
 * @package Sfynx\DddBundle\Layer\Presentation\Adapter\Generalisation
 */
interface QueryAdapterInterface
{
    /**
     * @param QueryRequestInterface $request
     * @return mixed
     */
    public function createQueryFromRequest(QueryRequestInterface $request);
}