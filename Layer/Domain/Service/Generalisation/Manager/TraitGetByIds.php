<?php

namespace Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager;

use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;

trait TraitGetByIds
{
    /**
     * @var AbstractGetByIdsRepository
     */
    protected $getByIdsRepository;

    /**
     * @param string $entityIds
     * @return array
     */
    public function findByIds($entityIds)
    {
        $object = new \stdClass();
        $object->entityIds = $entityIds;

        return $this->factory->buildRepository(RepositoryFactoryInterface::GETBYIDS_REPOSITORY)->execute($object);
    }
}
