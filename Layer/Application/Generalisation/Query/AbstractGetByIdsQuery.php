<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Query;

use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;

/**
 * Class AbstractGetByIdsQuery.
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Generalisation
 * @abstract
 */
class AbstractGetByIdsQuery implements QueryInterface
{
    /**
     * @var array
     */
    protected $entityIds;

    /**
     * AbstractGetByIdsQuery constructor.
     *
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