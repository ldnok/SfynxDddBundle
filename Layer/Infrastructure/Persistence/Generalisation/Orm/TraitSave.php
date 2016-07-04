<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

/**
 * Trait Repository
 *
 * @category   Generalisation
 * @package    Trait
 * @subpackage Repository
 * @abstract
 */
trait TraitSave
{
    /**
     * {@inheritdoc}
     */
    public function save($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();

        return $entity;
    }
}
