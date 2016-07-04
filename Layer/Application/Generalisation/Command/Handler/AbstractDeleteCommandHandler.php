<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Command\Handler;

use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\CommandHandlerInterface;
use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager\ManagerInterface;

/**
 * Class AbstractDeleteCommandHandler
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Command
 * @abstract
 */
abstract class AbstractDeleteCommandHandler implements CommandHandlerInterface
{
    /**
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function process(CommandInterface $command)
    {
        return $this->manager->removeById($command->getEntityId(), $command->getRevision());
    }
}
