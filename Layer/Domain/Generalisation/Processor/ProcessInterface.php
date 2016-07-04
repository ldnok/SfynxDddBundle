<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Processor;

/**
 * Interface ProcessInterface
 * @package Sfynx\DddBundle\Layer\Service\Generalisation\Processor
 */
interface ProcessInterface
{
    /**
     * @param mixed $object
     * @return void
     */
    public function update($object);
}
