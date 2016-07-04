<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Repository;

/**
 * Interface SaveRepositoryInterface.
 *
 * @package Sfynx\DddBundle\Layer\Domain\Generalisation\Repository
 */
interface SaveRepositoryInterface
{
    /**
     * @param \stdClass $object
     *
     * @return mixed
     */
    public function execute(\stdClass $object);
}
