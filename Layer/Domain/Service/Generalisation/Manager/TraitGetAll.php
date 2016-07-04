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
     * @param $orderBy
     * @param $isAsc
     * @return array
     */
    public function all($start, $count, $orderBy, $isAsc)
    {
        $object = new \stdClass();
        $object->start = $start;
        $object->count = $count;
        $object->orderBy = $orderBy;
        $object->isAsc = $isAsc;

        return $this->factory->buildRepository(RepositoryFactoryInterface::ALL_REPOSITORY)->execute($object);
    }
}
