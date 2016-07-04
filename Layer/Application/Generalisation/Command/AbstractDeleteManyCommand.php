<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Command;

/**
 * Class AbstractDeleteManyCommand
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractDeleteManyCommand extends AbstractCommand
{
    /**
     * @var array
     */
    protected $entityIds;

    /**
     * AbstractDeleteManyCommand constructor.
     * @param array $entityIds
     */
    public function __construct($entityIds)
    {
        $this->entityIds = $entityIds;
    }

    /**
     * @return array
     */
    public function getEntityIds()
    {
        return $this->entityIds;
    }

    /**
     * @param array $entityIds
     */
    public function setEntityIds($entityIds)
    {
        $this->entityIds = $entityIds;
    }
}
