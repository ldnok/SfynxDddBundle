<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\CouchDB;

use Sfynx\DddBundle\Layer\Infrastructure\Exception\PersistenceException;
use DemoApiContext\Infrastructure\Persistence\Repository\Actor\CouchDB\views\ActorDesignDocument;

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
    public function execute(\stdClass $object)
    {
        return $this->findByIds($object->entityIds);
    }

    protected function findByIds($entityIds)
    {
        if (empty($entityIds)) {
            throw new PersistenceException('entityIds can\'t be empty');
        }
        $client = $this->_dm->getCouchDBClient();

//        //other solution but need to create document
//        $data = $client->findDocuments($entityIds);

          //other solution but need to create document
        $client->createDesignDocument('actors', new ActorDesignDocument());
        $query = $this->_dm->createQuery("actors", "by_id");
        $query->setReduce(false);
        $query->setKeys($entityIds);
        $data = $query->execute();

        $data = $this->_dm->getRepository($this->_entityName)->findMany($entityIds);

        return $data;
    }
}
