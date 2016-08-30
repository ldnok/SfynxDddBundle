<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Security\Connection;

use Sfynx\DddBundle\Layer\Infrastructure\Exception\InfrastructureException;
use Symfony\Component\Yaml\Parser;

class Multitenant
{
    /**
     * Get the tenant value
     *
     * @return string
     * @throws \Exception
     */
    public static function getTenantId()
    {
        if (null === $_SERVER['HTTP_X_TENANT_ID']) {
            throw InfrastructureException::NoDataHeader("id tenant X-TENANT-ID");
        }

        return $_SERVER['HTTP_X_TENANT_ID'];
    }

    /**
     * Get the name of the database of the tenant
     *
     * @param string  $database_multitenant_path_file
     * @param integer $tenant_id
     *
     * @static
     * @return string
     * @throws \Exception
     */
    public static function getDbName($database_multitenant_path_file, $tenant_id = null)
    {
        $data_tenant = self::getTenantValue($database_multitenant_path_file, $tenant_id);

        return $data_tenant['dbname']['name'];
    }

    /**
     * Get the name of the database of the tenant
     *
     * @param string  $database_multitenant_path_file
     * @param string  $class
     * @param integer $tenant_id
     *
     * @static
     * @return string
     * @throws \Exception
     */
    public static function getTbNameByClass($database_multitenant_path_file, $class, $tenant_id = null)
    {
        $data_tenant = self::getTenantValue($database_multitenant_path_file, $tenant_id);

        if(null === $data_tenant['tbname']['x-class'][$class]['name']) {
            return null;
        }

        return $data_tenant['tbname']['x-class'][$class]['name'];
    }

    /**
     * Get the name of the database of the tenant
     *
     * @param string  $database_multitenant_path_file
     * @param integer $tenant_id
     *
     * @static
     * @return array
     * @throws \Exception
     */
    public static function getTenantValue($database_multitenant_path_file, $tenant_id = null)
    {
        if (null === $tenant_id) {
            $tenant_id = (int) self::getTenantId();
        }

        $ymlParser = new Parser();
        $data = $ymlParser->parse(file_get_contents(realpath($database_multitenant_path_file)));

        if (null === $data['x-tenant-id'][$tenant_id]) {
            throw InfrastructureException::NoTenantDefinition($tenant_id);
        }

        return $data['x-tenant-id'][$tenant_id]['x-fields'];
    }
}
