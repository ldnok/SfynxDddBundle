<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Exception;

class InfrastructureException extends \Exception
{
    /**
     * Returns the <No Environment Parameter> Exception.
     *
     * @param $id integer
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function NoEnvParam($id)
    {
        return new self(sprintf('The environment variable %s does not exist in the server.', $id));
    }

    /**
     * Returns the <No Data Header passed in request> Exception.
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function NoDataHeader($data)
    {
        return new self(sprintf('The %s data is not passed in the header request.', $data));
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

    /**
     * Returns the <No Tenant database connection> Exception.
     *
     * @param $id integer
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function NoTenantDatabaseConnection($id)
    {
        return new self(sprintf('The connection of th database associated with the tenant %s is not done.', $id));
    }
}
