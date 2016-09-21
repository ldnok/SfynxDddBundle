<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\CouchDB;

use DemoApiContext\Infrastructure\Persistence\Repository\Actor\CouchDB\views\ActorDesignDocument;
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
        return $this->findAll($object->start, $object->count);
    }

    protected function findAll($start, $count)
    {
        $client = $this->_dm->getCouchDBClient();
//        //other solution
//        $data = $client->allDocs($count, null, null, $start);
        $client->createDesignDocument('actors', $this->designDocument);

        $query = $this->_dm->createQuery("actors", "all_actors")
            ->setReduce(false)
            ->setSkip($start)
            ->setLimit($count);
        $response = $query->execute();

        $data = [];
        //create document from response
        foreach($response as $row) {
            $hints = array();
            $document = $this->_dm->getUnitOfWork()->createDocument($this->_entityName, $row['value'], $hints); //we lose revision information when transforming to document
            $data[] = $document;
        }
        return $data;
    }
}
