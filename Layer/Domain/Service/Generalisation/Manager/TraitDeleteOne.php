<?php

namespace Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager;


use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;

trait TraitDeleteOne
{
    /**
     * @var AbstractDeleteRepository
     */
    protected $deleteOneRepository;

    /**
     * @param string $entityId
     *
     * @return integer
     */
    public function removeById($entityId, $revision)
    {
        $object = new \stdClass();
        $object->entityId = $entityId;
        $object->revision = $revision;

        return $this->factory->buildRepository(RepositoryFactoryInterface::DELETEONE_REPOSITORY)->execute($object);
    }
}
