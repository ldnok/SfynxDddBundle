<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\Resolver;


/**
 * Interface ResolverInterface.
 *
 * @category Presentation
 * @package Request
 * @subpackage Generalisation
 */
interface ResolverInterface
{
    /**
     * @param array $defaults
     * @return mixed
     */
    public function setDefaults(array $defaults);

    /**
     * @param $optionNames
     * @return mixed
     */
    public function setRequired($optionNames);

    /**
     * @param $option
     * @param null $allowedTypes
     * @return mixed
     */
    public function setAllowedTypes($option, $allowedTypes = null);

    /**
     * @param array $options
     * @return mixed
     */
    public function resolve(array $options = array());

    /**
     * @return void
     */
    public function clear();
}
