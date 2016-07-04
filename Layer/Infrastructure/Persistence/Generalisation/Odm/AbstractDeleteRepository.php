<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Odm;

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
        $qb = $this->_dm->createQueryBuilder($this->_entityName)
            ->remove()
            ->field('_id')
            ->equals($entityId);

        $result = $qb->getQuery()->execute();

        return $result['n'];
    }
}
