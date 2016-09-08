<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

use Sfynx\DddBundle\Layer\Infrastructure\Exception\PersistenceException;
use Sfynx\DddBundle\Layer\Infrastructure\Security\Connection\MultitenantDefinition;

/**
 * Class AbstractDeleteManyRepository
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Infrastructure
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractDeleteManyRepository extends AbstractRepository
{
    public function execute(\stdClass $object)
    {
        return $this->removeMany($object->entityIds);
    }

    protected function removeMany($entityIds)
    {
        if (empty($entityIds)) {
            throw new PersistenceException('entityIds can\'t be empty');
        }
        $qb = $this->_em->createQueryBuilder();
        $qb->delete($this->_entityName, 'a')
            ->andWhere('a.id IN (?1)')
            ->setParameter(1, $entityIds);
        $qb = $this->searchWithTenantId($_SERVER[MultitenantDefinition::HEADER_TENANT_ID_KEY], $qb);

        return $qb->getQuery()->execute();
    }
}
