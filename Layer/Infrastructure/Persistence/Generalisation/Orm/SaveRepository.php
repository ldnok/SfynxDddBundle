<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

use Sfynx\DddBundle\Layer\Domain\Generalisation\Repository\SaveRepositoryInterface;

class SaveRepository implements SaveRepositoryInterface
{
    use TraitSave;

    /**
     * @var EntityManager
     */
    protected $_em;

    /**
     * Initializes a new SaveRepository.
     *
     * @param EntityManager  $em  The EntityManager to use.
     */
    public function __construct($em)
    {
        $this->_em = $em;
    }

    public function execute(\stdClass $object)
    {
        $this->save($object->entity);
    }
}
