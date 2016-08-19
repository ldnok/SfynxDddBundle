<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

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
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from($this->_entityName, 'a')
            ->where('a.id = ?1')
            ->setParameter(1, $entityId);
        $qb = $this->searchWithTenantId($_SERVER['HTTP_X_TENANT_ID'], $qb);
        $query = $qb->getQuery();

        $result = $query->getResult();
        if (empty($result)) {
            return null;
        }

        return end($result);
    }
}
