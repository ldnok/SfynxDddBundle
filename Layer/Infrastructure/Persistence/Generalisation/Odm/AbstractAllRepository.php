<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Odm;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ODM\MongoDB\Query\Query;

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
        return $this->findAll($object->start, $object->count, $object->orderBy, $object->isAsc);
    }

    protected function findAll($start, $count, $orderBy, $isAsc)
    {
        // get database name
        // print_r(($this->_dm->getDocumentDatabase($this->_entityName)->getName()));

        $qb = $this->_dm->createQueryBuilder($this->_entityName)
            ->skip($start) //skip is not recommended for big amount of data because cursor always start at the beginning
            ->limit($count);
        $query = $qb->getQuery();
        $data = $query->execute();

        return $data->toArray();
    }
}
