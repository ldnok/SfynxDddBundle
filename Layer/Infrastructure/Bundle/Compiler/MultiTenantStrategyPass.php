<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Bundle\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MultiTenantStrategyPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function process(ContainerBuilder $container)
    {
        ConnectDriver::multiTenantHandler($container);

        // get params
        $type = $container->getParameter('database_type');

        if ('orm' === $type) {
            $connection_service = 'doctrine.dbal.default_connection'; // doctrine.orm.entity_manager
        }
        if ('odm' === $type) {
            $connection_service = 'doctrine_mongodb.odm.default_document_manager';
        }
        if ('couchdb' === $type) {
            $connection_service = 'doctrine_couchdb.odm.default_document_manager';
        }

        if ($container->hasDefinition($connection_service)) {
            $def = $container->getDefinition($connection_service);
            $args = $def->getArguments();
            $args[0]['driverClass'] = 'Sfynx\DddBundle\Layer\Infrastructure\Bundle\Compiler\ConnectDriver';
            $args[0]['driverOptions'][] = array(new Reference('security.context'));
            $def->replaceArgument(0, $args[0]);
        }
    }
}
