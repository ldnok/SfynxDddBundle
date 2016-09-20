<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

/**
 * Class AbstractAllRepository
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Infrastructure
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractAllRepository extends AbstractRepository
{
    public function execute(\stdClass $object)
    {
        return $this->findAll($object->start, $object->count);
    }

    protected function findAll($start, $count)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from($this->_entityName, 'a')
            ->setFirstResult($start)
            ->setMaxResults($count);

        return $qb->getQuery()->getResult();
    }
}
