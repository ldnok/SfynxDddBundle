<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Query;

use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;

/**
 * Class AbstractAllQuery.
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractOneQuery implements QueryInterface
{
    /**
     * @var string $entityId
     */
    protected $entityId;

    /**
     * @param $entityId
     */
    public function __construct($entityId)
    {
        $this->entityId = $entityId;
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
}
