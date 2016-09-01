<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Sfynx\DddBundle\Layer\Infrastructure\Security\Connection\Multitenant;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

use Doctrine\ODM\CouchDB\DocumentManager as CouchDBManager;
use Doctrine\ODM\MongoDB\DocumentManager as MongoDBManager;
use Doctrine\ORM\EntityManager;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\MySqlSchemaManager;

class HandlerDynamicTable
{
    protected $database_type;
    protected $database_multitenant_path_file;
    protected $kernel;

    public function __construct($database_type, $database_multitenant_path_file, \AppKernel $kernel)
    {
        $this->database_type = $database_type;
        $this->database_multitenant_path_file = $database_multitenant_path_file;
        $this->kernel = $kernel;
    }

    /**
     * Method which will be called when the event is thrown.
     *
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /* we get table name */
        $classMetadata = $eventArgs->getClassMetadata();
        $table = $classMetadata->table;
        $table['name'] = Multitenant::getTbNameByClass($this->database_multitenant_path_file, $classMetadata->name);

        if (null === $table['name']) {
            return;
        }

        $entityManager = $eventArgs->getEntityManager();
        if (('orm' === $this->database_type)
            || ('odm' === $this->database_type)
        ) {
            $schemaManager = $entityManager->getConnection()->getSchemaManager();
        } elseif ('couchdb' === $this->database_type) {
            $schemaManager = $entityManager->getSchemaManager();
        }

        /* we test if the table does not exist */
        if (false === $schemaManager->tablesExist(array($table['name']))) {
            /* we create the table if does not exist */
            $application = new Application($this->kernel);
            $application->setAutoExit(false);
            $application->run(new ArrayInput(array(
                'command' => 'doctrine:cache:clear-metadata',
                '--env='.$this->kernel->getEnvironment() => true
            )));
        }
        /* we change the table name */
        $classMetadata->setPrimaryTable($table);

        /* we test if the table does not exist */
        if (false === $schemaManager->tablesExist(array($table['name']))) {
            $schemaTool = new SchemaTool($entityManager);
            $schemaTool->createSchema([$classMetadata]);
        }
    }
}
