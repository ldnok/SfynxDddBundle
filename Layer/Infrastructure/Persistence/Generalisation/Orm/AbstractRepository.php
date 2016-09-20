<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

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
    protected $_em;

    /**
     * @var string $_entityName
     */
    protected $_entityName;

    /**
     * Initializes a new SaveRepository.
     *
     * @param EntityManager  $em  The EntityManager to use.
     */
    public function __construct($em)
    {
        $this->_em = $em;
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
