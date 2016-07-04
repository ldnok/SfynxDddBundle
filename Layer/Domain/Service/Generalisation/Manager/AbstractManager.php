<?php

namespace Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager;

use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;

/**
 * Class AbstractManager
 *
 * @package
 */
class AbstractManager implements ManagerInterface
{
    /**
     * @var RepositoryFactoryInterface
     */
    protected $factory;

    /**

     * @param RepositoryFactoryInterface $factory
     */
    public function __construct(RepositoryFactoryInterface $factory) {
        $this->factory = $factory;
    }
}
