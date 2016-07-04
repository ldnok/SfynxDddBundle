<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces;

/**
 * Interface CommandHandlerInterface
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Generalisation
 */
interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function process(CommandInterface $command);
}
