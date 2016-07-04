<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces;

/**
 * Interface QueryHandlerInterface
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Generalisation
 */
interface QueryHandlerInterface
{
    /**
     * @param QueryInterface $query
     * @return mixed
     */
    public function process(QueryInterface $query);
}
