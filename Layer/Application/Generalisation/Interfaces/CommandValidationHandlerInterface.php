<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces;

interface CommandValidationHandlerInterface
{
    /**
     * @var CommandInterface $command
     */
    public function process(CommandInterface $command);
}
