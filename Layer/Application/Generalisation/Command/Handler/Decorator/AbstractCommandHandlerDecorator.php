<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Command\Handler\Decorator;


use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\CommandHandlerInterface;
use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;

class AbstractCommandHandlerDecorator implements CommandHandlerInterface
{
    protected $commandHandler;

    public function __construct(CommandHandlerInterface $commandHandler)
    {
        $this->commandHandler = $commandHandler;
    }

    /**
     * Method to decorate (override)
     *
     * @param CommandInterface $command
     * @return mixed
     */
    public function process(CommandInterface $command)
    {
        return $this->commandHandler->process($command);
    }
}
