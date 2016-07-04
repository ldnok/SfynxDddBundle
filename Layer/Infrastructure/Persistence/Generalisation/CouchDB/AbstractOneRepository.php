<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\CouchDB;

use DemoApiContext\Infrastructure\Persistence\Repository\Actor\CouchDB\views\ActorDesignDocument;

/**
 * Class AbstractOneRepository
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Infrastructure
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractOneRepository extends AbstractRepository
{
    public function execute(\stdClass $object)
    {
        return $this->findOne($object->entityId);
    }

    protected function findOne($entityId)
    {
//        $client = $this->_dm->getCouchDBClient();

//        //other solution but return http response
//        $data = $client->findDocument($entityId);

          //other solution but return array
//        $client->createDesignDocument('actors', new ActorDesignDocument());
//        $query = $this->_dm->createQuery("actors", "by_id");
//        $query->setReduce(false);
//        $query->setKey($entityId);
//        $data = $query->execute();

        //create documents from response if need with createDocument method


        //best solution because it return an Actor object and others not
        $data = $this->_dm->find($this->_entityName, $entityId);

        return $data;
    }
}
