<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces;

/**
 * Interface CommandInterface
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Generalisation
 */
interface CommandInterface
{
    public function toArray($skipNull = false);
}
