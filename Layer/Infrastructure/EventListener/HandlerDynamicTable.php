<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Sfynx\DddBundle\Layer\Infrastructure\Security\Connection\Multitenant;
use Doctrine\ORM\Mapping\ClassMetadata;
use \Doctrine\ORM\Tools\SchemaTool;

class HandlerDynamicTable
{
    protected $database_type;
    protected $database_multitenant_path_file;

    public function __construct($database_type, $database_multitenant_path_file)
    {
        $this->database_type = $database_type;
        $this->database_multitenant_path_file = $database_multitenant_path_file;
    }

    /**
     * Method which will be called when the event is thrown.
     *
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();
        $table = $classMetadata->table;

        $table['name'] = Multitenant::getTbNameByClass($this->database_multitenant_path_file, $classMetadata->name);

        if (null === $table['name']) {
            return;
        }

        $classMetadata->setPrimaryTable($table);

        /* we create the table if does not exist*/
        $entityManager = $eventArgs->getEntityManager();

        $schemaTool = new SchemaTool($entityManager);
//        $classes = $entityManager->getMetadataFactory()->getAllMetadata();
        $classes = array($classMetadata);
        $schemaTool->createSchema($classes);
    }
}
