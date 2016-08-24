<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Custom Exception handler.
 *
 * @category   Exception
 * @package    EventListener
 * @subpackage Handler
 */
class HandlerException
{
    /**
     * @var EngineInterface $templating The templating service
     */
    protected $templating;

    /**
     * @var string $locale The locale value
     */
    protected $locale;

    /**
     * @var ContainerInterface $container The service container
     */
    protected $container;

    /**
     * @var \AppKernel $kernel Kernel service
     */
    protected $kernel;

    /**
     * Constructor.
     *
     * @param EngineInterface    $templating The templating service
     * @param \AppKernel         $kernel     The kernel service
     * @param ContainerInterface $container  The containerservice
     */
    public function __construct(
        EngineInterface $templating,
        \AppKernel $kernel,
        ContainerInterface $container
    ) {
        $this->container  = $container;
        $this->templating = $templating;
        $this->locale     = $this->container->get('request')->getLocale();
        $this->kernel     = $kernel;
    }

    /**
     * Event handler that renders not found page
     * in case of a NotFoundHttpException
     *
     * @param GetResponseForExceptionEvent $event
     *
     * @access public
     * @return void
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $this->request = $event->getRequest($event);
        // exception object
        $exception = $event->getException();
        // new Response object
        $response = new JsonResponse(
            [
                'code' =>$exception->getCode(),
                'message'=>$exception->getMessage()
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
        // HttpExceptionInterface is a special type of exception
        // that holds status code and header details
        if (method_exists($exception, "getStatusCode")) {
            $response->setStatusCode($exception->getStatusCode());
        }
        if (method_exists($response, "getHeaders")) {
            $response->headers->replace($exception->getHeaders());
        }
        // set the new $response object to the $event
        $event->setResponse($response);
    }
}
