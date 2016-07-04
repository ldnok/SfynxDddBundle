<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation;

/**
 * Interface CommandRequestInterface
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Presentation
 * @subpackage Generalisation
 */
interface CommandRequestInterface
{
    /**
     * @return mixed
     */
    public function getRequestParameters();
}
