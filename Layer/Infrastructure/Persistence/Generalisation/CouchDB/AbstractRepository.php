<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\CouchDB;
use DemoApiContext\Infrastructure\Persistence\Repository\Actor\CouchDB\views\AbstractDesignDocument;

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
     * @var AbstractDesignDocument
     */
    protected $designDocument;

    /**
     * @return mixed
     */
    abstract public function initDesignDocument();

    /**
     * @param EntityManager  $dm  The EntityManager to use.
     */
    public function __construct($dm)
    {
        $this->_dm = $dm;
        $this->initEntityName();
        $this->initDesignDocument();
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
