<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Security\Connection;

use Sfynx\DddBundle\Layer\Infrastructure\Exception\InfrastructureException;

class MultitenantDefinition
{
    const HEADER_TENANT_ID_KEY = 'HTTP_X_TENANT_ID';
    const ENTRY_CLASS_KEY = 'x-class';
    const ENTRY_FIELDS_KEY = 'x-fields';
    const LIST_TENANTS_ID_KEY = 'x-tenant-id';

    public static function verifyHeader(array $aData)
    {
        if (null === $aData[self::HEADER_TENANT_ID_KEY]) {
            throw InfrastructureException::NoDataHeader("id tenant X-TENANT-ID");
        }
    }
}