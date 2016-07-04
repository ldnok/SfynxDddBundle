<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Command;

/**
 * Class AbstractDeleteCommand.
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractDeleteCommand extends AbstractCommand
{
    /**
     * @var string
     */
    protected $entityId;

    /**
     * @var string
     */
    protected $revision;

    /**
     * AbstractDeleteCommand constructor.
     *
     * @param string $entityId
     * @param string|null $revision
     */
    public function __construct($entityId, $revision = null)
    {
        $this->entityId = $entityId;
        $this->revision = $revision;
    }

    /**
     * @return mixed
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @param mixed $entityId
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
    }

    /**
     * @return string
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @param string $revision
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;
    }
}
