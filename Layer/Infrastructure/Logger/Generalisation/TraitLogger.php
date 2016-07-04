<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Logger\Generalisation;

trait TraitLogger
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
