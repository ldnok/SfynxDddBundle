<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Odm;

use Sfynx\DddBundle\Layer\Infrastructure\Exception\PersistenceException;

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
     * @param $entityIds
     * @return null or entity
     */
    protected function findByIds($entityIds)
    {
        if (empty($entityIds)) {
            throw new PersistenceException('entityIds can\'t be empty');
        }
        $qb = $this->_dm->createQueryBuilder($this->_entityName)
            ->field('_id')
            ->in($entityIds);
        $query = $qb->getQuery();
        $data = $query->execute();

        return $data->toArray();
    }
}
