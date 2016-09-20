<?php

namespace Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager;

use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;

trait TraitGetAll
{
    /**
     * @var AbstractAllRepository
     */
    protected $allRepository;

    /**
     * @param $start
     * @param $count
     * @return array
     */
    public function all($start, $count)
    {
        $object = new \stdClass();
        $object->start = $start;
        $object->count = $count;

        return $this->factory->buildRepository(RepositoryFactoryInterface::ALL_REPOSITORY)->execute($object);
    }
}
