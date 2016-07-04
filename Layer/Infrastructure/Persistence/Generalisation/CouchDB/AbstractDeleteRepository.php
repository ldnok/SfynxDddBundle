<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\CouchDB;

use DemoApiContext\Infrastructure\Persistence\Repository\Actor\CouchDB\views\ActorDesignDocument;

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
        return $this->remove($object->entityId, $object->revision);
    }

    protected function remove($entityId, $rev)
    {
        $client = $this->_dm->getCouchDBClient();
        $client->deleteDocument($entityId, $rev);//empty result

        return 1;
    }
}
