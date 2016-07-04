<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Odm;

use Sfynx\DddBundle\Layer\Domain\Generalisation\Repository\SaveRepositoryInterface;

class SaveRepository implements SaveRepositoryInterface
{
    use TraitSave;

    /**
     * @var EntityManager
     */
    protected $_dm;

    /**
     * Initializes a new SaveRepository.
     *
     * @param EntityManager  $em  The EntityManager to use.
     */
    public function __construct($dm)
    {
        $this->_dm = $dm;
    }

    public function execute(\stdClass $object)
    {
        $this->save($object->entity);
    }
}
