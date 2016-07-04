<?php

namespace Sfynx\DddBundle\Layer\Presentation\Response\Handler;

use Symfony\Component\HttpFoundation\Response;
use Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\Request\RequestInterface;
use Sfynx\DddBundle\Layer\Infrastructure\Serializer\SerializerInterface;
use Sfynx\DddBundle\Layer\Presentation\Response\Generalisation\ResponseHandlerInterface;

/**
 * ResponseHandler.
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Presentation
 * @subpackage Response
 */
class ResponseHandler implements ResponseHandlerInterface
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var string
     */
    protected $format;

    /**
     * ResponseHandler constructor.
     *
     * @param SerializerInterface $serializer
     * @param RequestInterface $request
     */
    public function __construct(SerializerInterface $serializer, RequestInterface $request)
    {
        $this->setSerializer($serializer);
        $this->setRequest($request);
        $this->setFormat($request->getRequestFormat());
        $this->setVersion($request->get('_version'));
    }

    /**
     * Convenience method to allow for a fluent interface.
     *
     * @param mixed $data
     * @param int   $statusCode
     * @param array $headers
     *
     * @return ResponseHandler
     */
    public function create($data = null, $statusCode = null, array $headers = array())
    {
        $this->setStatusCode($statusCode ?: Response::HTTP_OK);
        $this->setHeaders($headers);
        $this->setData($data);

        return $this;
    }

    /**
     * Gets the response.
     *
     * @return Response
     */
    public function getResponse()
    {
        if (null === $this->response) {
            $this->response = new Response();
        }

        return $this->response;
    }

    /**
     * Gets the HTTP status code.
     *
     * @return int|null
     */
    protected function getStatusCode()
    {
        return $this->getResponse()->getStatusCode();
    }

    /**
     * Sets the RequestInterface object.
     *
     * @param RequestInterface $request
     *
     * @return ResponseHandler
     */
    protected function setRequest(RequestInterface $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Sets the HTTP status code.
     *
     * @param int $code
     *
     * @return ResponseHandler
     */
    protected function setStatusCode($code)
    {
        $this->getResponse()->setStatusCode($code);

        return $this;
    }

    /**
     * Gets the headers.
     *
     * @return array
     */
    protected function getHeaders()
    {
        return $this->getResponse()->headers->all();
    }

    /**
     * Sets the headers.
     *
     * @param array $headers
     *
     * @return ResponseHandler
     */
    protected function setHeaders(array $headers)
    {
        if (!$this->getResponse()->headers->has('Content-Type')) {
            $this->getResponse()->headers->set('Content-Type', $this->request->getMimeType($this->getFormat()));
        }
        if (!empty($headers)) {
            $this->getResponse()->headers->replace($headers);
        }

        return $this;
    }

    /**
     * Gets the format.
     *
     * @return string|null
     */
    protected function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets the format.
     *
     * @param string $format
     *
     * @return ResponseHandler
     */
    protected function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @param int $version
     */
    protected function setVersion($version = 1)
    {
        $this->getSerializer()->getSerializationContext()->setVersion($version);
    }

    /**
     * Sets the data.
     *
     * @param mixed $data
     *
     * @return ResponseHandler
     */
    protected function setData($data)
    {
        if (null !== $data) {
            $this->getResponse()->setContent(
                $this->getSerializer()->serialize($data, $this->getFormat())
            );
        }

        return $this;
    }

    /**
     * Gets the serialization
     *
     * @return SerializerInterface
     */
    protected function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param SerializerInterface $serializer
     *
     * @return $this
     */
    protected function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;

        return $this;
    }
}
