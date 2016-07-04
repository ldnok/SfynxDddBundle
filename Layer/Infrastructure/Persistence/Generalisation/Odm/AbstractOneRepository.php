<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Odm;

/**
 * Class AbstractOneRepository
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Infrastructure
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractOneRepository extends AbstractRepository
{
    /**
     * @param \stdClass $object
     * @return mixed
     */
    public function execute(\stdClass $object)
    {
        return $this->find($object->entityId);
    }

    /**
     * @param $entityId
     * @return null or entity
     */
    protected function find($entityId)
    {
        $qb = $this->_dm->createQueryBuilder($this->_entityName)
            ->field('_id')->equals($entityId);
        $query = $qb->getQuery();
        $data = $query->getSingleResult();

        return $data;
    }
}
