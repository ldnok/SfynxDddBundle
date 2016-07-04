<?php

namespace Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager;


use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;

trait TraitDeleteMany
{
    /**
     * @var AbstractDeleteManyRepository
     */
    protected $deleteManyRepository;

    /**
     * @param array $entityIds
     *
     * @return integer
     */
    public function removeByIds($entityIds)
    {
        $object = new \stdClass();
        $object->entityIds = $entityIds;

        return $this->factory->buildRepository(RepositoryFactoryInterface::DELETEMANY_REPOSITORY)->execute($object);
    }
}
