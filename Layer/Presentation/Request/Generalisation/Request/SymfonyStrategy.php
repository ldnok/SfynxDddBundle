<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\Request;

/**
 * Default Request strategy .
 *
 * @category   Strategy
 * @package    Presentation
 * @subpackage Request
 */
class SymfonyStrategy extends AbstractRequest
{
    /** @var request */
    protected $request = null;

    public function __construct($request = null)
    {
        $this->request = $request->getCurrentRequest();
        if(!(null === $this->request)) {
            $this->setInit();
        }
    }

    public function getInstance()
    {
        return $this->resquest;
    }

    public function getContent($asResource = false)
    {
        return $this->request->getContent($asResource);
    }

    public function get($key, $default = null, $deep = false)
    {
        return $this->request->get($key, $default, $deep);
    }

    public function getRequestFormat($default = 'json')
    {
        return $this->request->getRequestFormat($default);
    }

    public function getMimeType($format)
    {
        return $this->request->getMimeType($format);
    }

    public function isXmlHttpRequest()
    {
        return $this->request->isXmlHttpRequest();
    }

    public function setLocale($locale)
    {
        $this->request->setLocale($locale);
    }

    public function getLocale()
    {
        return $this->request->getLocale();
    }

    protected function setInit()
    {
        $this->setCookies();
        $this->setQuery();
        $this->setHeader();
        $this->setAttributes();
        $this->setFiles();
        $this->setServer();
    }

    protected function setCookies()
    {
        $this->cookies = $this->request->cookies;
    }

    protected function setQuery()
    {
        $this->query = $this->request->query;
    }

    protected function setHeader()
    {
        $this->headers = $this->request->headers;
    }

    protected function setAttributes()
    {
        $this->attributes = $this->request->attributes;
    }

    protected function setFiles()
    {
        $this->files = $this->request->files;
    }

    protected function setServer()
    {
        $this->server = $this->request->server;
    }
}
