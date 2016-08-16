<?php

namespace Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager;

use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;

trait TraitSearchBy
{

    /**
     * @param $start
     * @param $count
     * @param $orderBy
     * @param $isAsc
     * @return array
     */
    public function searchBy($criterias, $start, $count)
    {
        $object = new \stdClass();
        $object->criterias = $criterias;
        $object->start = $start;
        $object->count = $count;

        return $this->factory->buildRepository(RepositoryFactoryInterface::SEARCHBY_REPOSITORY)->execute($object);
    }
}
