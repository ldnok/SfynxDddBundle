<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\CouchDB;

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
        throw new \Exception("not implemented");
    }
}
