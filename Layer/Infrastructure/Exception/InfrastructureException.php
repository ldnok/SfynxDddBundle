<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Exception;

class InfrastructureException extends \Exception
{
    /**
     * Returns the <No Id Tenant from Data Header> Exception.
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function NoIdTenantDataHeader()
    {
        return new self(sprintf('The id tenant X-TENANT-ID is not passed in the header request.'));
    }

    /**
     * Returns the <No Tenant Environment Parameter> Exception.
     *
     * @param $id integer
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function NoTenantEnvParam($id)
    {
        return new self(sprintf('The env parameter X_TENANT_ID_%s is not passed in the header request.', $id));
    }

    /**
     * Returns the <No Tenant Definition in the multi-tenant description file> Exception.
     *
     * @param $id integer
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function NoTenantDefinition($id)
    {
        return new self(sprintf('The tenant %s is not define in the multi-tenants file.', $id));
    }
}
