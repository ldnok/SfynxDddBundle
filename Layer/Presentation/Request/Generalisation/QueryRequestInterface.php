<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation;

/**
 * Interface QueryRequestInterface
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Presentation
 * @subpackage Generalisation
 */
interface QueryRequestInterface
{
    /**
     * @return mixed
     */
    public function getRequestParameters();
}
