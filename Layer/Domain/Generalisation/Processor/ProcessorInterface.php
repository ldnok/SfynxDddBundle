<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Processor;

/**
 * Interface ProcessorInterface
 * @package Sfynx\DddBundle\Layer\Domain\Generalisation\Processor
 */
interface ProcessorInterface
{
    /**
     * @param $key
     * @param ProcessInterface $process
     * @return void
     */
    public function addProcess($key, ProcessInterface $process);

    /**
     * @param string $key
     * @param mixed $object
     * @return void
     */
    public function executeProcess($key, $object);
}
