<?php

namespace Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager;

use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;

trait TraitGetOne
{
    /**
     * @param string $entityId
     * @return entity
     */
    public function find($entityId)
    {
        $object = new \stdClass();
        $object->entityId = $entityId;

        //404 if not found ?
        return $this->factory->buildRepository(RepositoryFactoryInterface::ONE_REPOSITORY)->execute($object);
    }
}
