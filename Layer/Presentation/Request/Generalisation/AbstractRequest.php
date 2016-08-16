<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation;

use Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\Request\RequestInterface;
use Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\Resolver\ResolverInterface;

/**
 * Class AbstractRequest
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Presentation
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractRequest
{
    protected $defaults = [];
    protected $required = [];
    protected $allowedTypes = [];

    /**
     * @var array
     */
    protected $requestParameters;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param RequestInterface  $request
     * @param ResolverInterface $resolver
     */
    public function __construct(RequestInterface $request, ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
        $this->request  = $request;

        $this->process();
    }

    /**
     * @return array
     */
    public function getRequestParameters()
    {
        return $this->requestParameters;
    }

    protected function process()
    {
        $this->setOptions();
        if (null === $this->options) {
            //todo: throw ... Json invalid
        }
        $this->resolver->setDefaults($this->defaults);
        $this->resolver->setRequired($this->required);
        $this->resolver->setAllowedTypes($this->allowedTypes);

        $this->requestParameters = $this->resolver->resolve($this->options);
    }

    /**
     * @return void
     */
    protected function setOptions()
    {
        //get request body
        $this->options = json_decode($this->request->getContent(), true);
        $this->options = (null !== $this->options) ? $this->options : [];


    }
}
