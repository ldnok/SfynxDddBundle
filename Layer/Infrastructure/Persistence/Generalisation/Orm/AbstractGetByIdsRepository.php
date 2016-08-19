<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

/**
 * Class AbstractGetByIdsRepository
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Infrastructure
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractGetByIdsRepository extends AbstractRepository
{
    /**
     * @param \stdClass $object
     * @return mixed
     */
    public function execute(\stdClass $object)
    {
        return $this->findByIds($object->entityIds);
    }

    /**
     * @param $entityId
     * @return null or entity
     */
    protected function findByIds($entityIds)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from($this->_entityName, 'a')
            ->where('a.id IN (?1)')
            ->setParameter(1, $entityIds);
        $qb = $this->searchWithTenantId($_SERVER['HTTP_X_TENANT_ID'], $qb);

        return $qb->getQuery()->getResult();
    }
}
