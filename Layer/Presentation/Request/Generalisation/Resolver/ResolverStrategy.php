<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\Resolver;

/**
 * Class ResolverStrategy.
 *
 * @category Presentation
 * @package Request
 * @subpackage Generalisation
 */
class ResolverStrategy implements  ResolverInterface
{
    /**
     * @var OptionsResolver
     */
    protected $resolver;

    /**
     * ResolverStrategy constructor.
     * @param $optionsResolver
     */
    public function __construct($optionsResolver)
    {
        $this->resolver = $optionsResolver;
    }

    /**
     * @param array $defaults
     * @return mixed
     */
    public function setDefaults(array $defaults)
    {
        return $this->resolver->setDefaults($defaults);
    }

    /**
     * @param $optionNames
     * @return mixed
     */
    public function setRequired($optionNames)
    {
        return $this->resolver->setRequired($optionNames);
    }

    /**
     * @param $option
     * @param null $allowedTypes
     * @return mixed
     */
    public function setAllowedTypes($option, $allowedTypes = null)
    {
        return $this->resolver->setAllowedTypes($option, $allowedTypes);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function resolve(array $options = array())
    {
        return $this->resolver->resolve($options);
    }
}
