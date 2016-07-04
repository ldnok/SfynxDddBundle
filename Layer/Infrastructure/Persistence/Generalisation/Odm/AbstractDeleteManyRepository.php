<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Odm;

use Sfynx\DddBundle\Layer\Infrastructure\Exception\PersistenceException;

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
        $qb = $this->_dm->createQueryBuilder($this->_entityName)
            ->remove()
            ->field('_id')
            ->in($entityIds);

        $result = $qb->getQuery()->execute();

        return $result['n'];
    }
}
