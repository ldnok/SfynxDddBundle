<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Bundle\Compiler;

use Doctrine\DBAL\Driver\PDOMySql\Driver;
use Sfynx\DddBundle\Layer\Infrastructure\Exception\InfrastructureException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

class ConnectDriver extends Driver
{
    public function connect(array $params, $username = null, $password = null, array $driverOptions = array())
    {
        $params['dbname'] = self::getDbName();

        return parent::connect($params, $username, $password, $driverOptions);
    }

    public static function multiTenantHandler(ContainerBuilder $container)
    {
        $tenant_id = ConnectDriver::getTenant();

        if (!getenv("X_TENANT_ID_$tenant_id")) {
            // we get all tenant values
            $ymlParser = new Parser();
            $file = $ymlParser->parse(file_get_contents($container->getParameter('database_multitenant_path_file')));
            // we create the tenant environment
            try {
                $values['dbname'] = $file[$tenant_id]['dbname'];
                $values['tbname'] = $file[$tenant_id]['tbname'];
                $value = serialize($values);
                putenv("X_TENANT_ID_$tenant_id=$value");
            } catch (\Exception $e) {
                throw InfrastructureException::NoTenantDefinition($tenant_id);
            }
        }
    }

    /**
     * Get the name of the database of the tenant
     *
     * @return string
     * @throws \Exception
     */
    public static function getDbName()
    {
        $tenant_id = self::getTenant();

        try {
            // get dbname from multi-tenant file
            $data_tenant = unserialize(getenv("X_TENANT_ID_$tenant_id"));
            return $data_tenant['dbname'];
        } catch (\Exception $e) {
            throw InfrastructureException::NoTenantEnvParam($tenant_id);
        }
    }

    /**
     * Get the tenant value
     *
     * @return string
     * @throws \Exception
     */
    public static function getTenant()
    {
        try {
            return $_SERVER['HTTP_X_TENANT_ID'];
        } catch (\Exception $e) {
            throw InfrastructureException::NoIdTenantDataHeader();
        }
    }
}
