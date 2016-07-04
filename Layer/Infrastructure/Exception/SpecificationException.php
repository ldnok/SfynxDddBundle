<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Exception;

class SpecificationException extends \Exception
{
    /**
     * Returns the <Profiler> Exception.
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function Profiler($errors)
    {
        return new self(sprintf('%s', $errors));
    }

    /**
     * Returns the <No StdClass Object> Exception.
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function NoStdClassObject()
    {
        return new self(sprintf('bad format object for specHandler. It must be a stdClass'));
    }

    /**
     * Returns the <Bad Interface Specification> Exception.
     *
     * @return \Exception
     * @access public
     * @static
     */
    public static function BadInterfaceSpecification()
    {
        return new self(sprintf('bad format specification for specHandler. It must be a InterfaceSpecification'));
    }
}
