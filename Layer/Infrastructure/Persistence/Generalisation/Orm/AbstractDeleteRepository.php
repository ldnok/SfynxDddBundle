<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

/**
 * Class AbstractDeleteRepository
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Infrastructure
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractDeleteRepository extends AbstractRepository
{
    public function execute(\stdClass $object)
    {
        return $this->remove($object->entityId);
    }

    protected function remove($entityId)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->delete($this->_entityName, 'a')
            ->andWhere('a.id = ?1')
            ->setParameter(1, $entityId);
        $qb = $this->searchWithTenantId($_SERVER[MultitenantDefinition::HEADER_TENANT_ID_KEY], $qb);
        $result = $qb->getQuery()->execute();

        return $result;
    }
}
