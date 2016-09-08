<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Security\Connection;

use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager\ManagerInterface;
use Sfynx\DddBundle\Layer\Infrastructure\Exception\InfrastructureException;

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
        MultitenantDefinition::verifyHeader($_SERVER);

        return $_SERVER[MultitenantDefinition::HEADER_TENANT_ID_KEY];
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
    public static function getDbName(ManagerInterface $oManager, boolean $bUseDb, string $sTenantCacheDir, string $sDefaultTenantFilePath, $iTenantId = null)
    {
        $aData = self::getTenantValue($oManager, $bUseDb, $sTenantCacheDir, $sDefaultTenantFilePath, $iTenantId);

        return $aData['dbname']['name'];
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
    public static function getTbNameByClass(ManagerInterface $oManager, boolean $bUseDb, string $sTenantCacheDir, string $sDefaultTenantFilePath, $class, $iTenantId = null)
    {
        $aData = self::getTenantValue($oManager, $bUseDb, $sTenantCacheDir, $sDefaultTenantFilePath, $iTenantId);

        if(null === $aData['tbname'][MultitenantDefinition::ENTRY_CLASS_KEY][$class]['name']) {
            return null;
        }

        return $aData['tbname'][MultitenantDefinition::ENTRY_CLASS_KEY][$class]['name'];
    }

    public static function getTenantValue(ManagerInterface $oManager, boolean $bUseDb, string $sTenantCacheDir, string $sDefaultTenantFilePath, int $iTenantId = null) : array
    {
        if (null === $iTenantId) {
            $iTenantId = (int) self::getTenantId();
        }
        $aData = self::loadTenantData($oManager, $bUseDb, $sTenantCacheDir, $sDefaultTenantFilePath, $iTenantId);

        return $aData[MultitenantDefinition::ENTRY_FIELDS_KEY];
    }

    public static function loadTenantData(ManagerInterface $oManager, boolean $bUseDb, string $sTenantCacheDir, string $sDefaultTenantFilePath, int $iTenantId) : array
    {
        $sCacheFilePath = sprintf('%s%s%s.json', $sTenantCacheDir, '/', $iTenantId);
        $aData = null;
        $bWriteCache = false;
        //1. look in cache
        if (file_exists($sCacheFilePath)) {
            $aData = json_decode(file_get_contents(realpath($sCacheFilePath)), true);
        } else {
            $bWriteCache = true;
        }
        //2. look in db if $bUseDb is true
        if (empty($aData) && $bUseDb) {
            $aData = json_decode($oManager->find($iTenantId), true);
        }
        //3. try in the default tenant file
        $bExtractIdFromList = false;
        if (empty($aData) && file_exists($sDefaultTenantFilePath)) {
            $bExtractIdFromList = true;
            $aData = json_decode(file_get_contents(realpath($sDefaultTenantFilePath)), true);
        }
        //no tenant file or data found for this id
        if (empty($aData)) {
            throw InfrastructureException::NoTenantDefinitionFile($iTenantId);
        }
        //$aData comes from the default tenant file so we need to extract
        if ($bExtractIdFromList) {
            if (empty($aData[MultitenantDefinition::LIST_TENANTS_ID_KEY][$iTenantId])) {
                throw InfrastructureException::NoTenantDefinition($iTenantId);
            }
            $aData = $aData[MultitenantDefinition::LIST_TENANTS_ID_KEY][$iTenantId];
        }
        //the cache must be set
        if ($bWriteCache) {
            file_put_contents($sCacheFilePath, json_encode($aData));//todo replace with sfynx-cache?
        }

        return $aData;
    }
}
