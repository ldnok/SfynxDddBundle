<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Bundle\Traits;

use Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\MultipleDatabase;
use Sfynx\DddBundle\Layer\Infrastructure\Bundle\Compiler\MultiTenantStrategyPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

trait TraitLoadBundle
{
    protected function loadBoot(ContainerInterface $container)
    {
        $dbDriver = $container->getParameter('database.driver');

        if (MultipleDatabase::ORM_DATABASE_TYPE === $dbDriver) {
            $this->loadOrmTypes();
        }

        if (MultipleDatabase::ODM_DATABASE_TYPE === $dbDriver) {
            $this->loadOdmTypes();
        }

        if (MultipleDatabase::COUCHDB_DATABASE_TYPE === $dbDriver) {
            $this->loadCouchDBTypes();
        }
    }

    protected function loadCompilerPass(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MultiTenantStrategyPass());
    }
}
