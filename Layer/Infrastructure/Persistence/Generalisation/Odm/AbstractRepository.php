<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Odm;

/**
 * Class AbstractRepository
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Infrastructure
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractRepository
{
    /**
     * @var EntityManager
     */
    protected $_dm;

    /**
     * @var string $_entityName
     */
    protected $_entityName;

    /**
     * Initializes a new SaveRepository.
     *
     * @param EntityManager  $dm  The EntityManager to use.
     */
    public function __construct($dm)
    {
        $this->_dm = $dm;
        $this->initEntityName();
    }

    public function getEntityName()
    {
        return $this->_entityName;
    }

    public function setEntityName($entityName)
    {
        $this->_entityName = $entityName;
    }

    abstract protected function initEntityName();
}
