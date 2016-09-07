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
    public static function getTenantValue(boolean $bUseDb, string $sTenantCacheDir, string $sTenantFilePath, int $sTenantId = null) : array
    {
        if (null === $sTenantId) {
            $sTenantId = (int) self::getTenantId();
        }
        
        $jsonFile = sprintf('%s%s%s', $sTenantCacheDir, '/', $sTenantId);
        if (file_exists($jsonFile)) {
            $data = json_decode(file_get_contents(realpath($sTenantFilePath)), true);
            $data = $data['x-fields'];
        } elseif ($bUseDb && false) {//todo
            $data = []; //todo
            //load in db
            //+ créer le fichier json
            file_put_contents($jsonFile, json_encode($data));
        } elseif (file_exists($sTenantFilePath)) {
            $data = json_decode(file_get_contents(realpath($sTenantFilePath)), true);
            $data = $data['x-tenant-id'][$sTenantId]['x-fields'];
        } else {
            throw InfrastructureException::NoTenantDefinitionFile($sTenantId);
        }

        if (null === $data['x-tenant-id'][$sTenantId]) {
            throw InfrastructureException::NoTenantDefinition($sTenantId);
        }

        return $data;
    }
}
