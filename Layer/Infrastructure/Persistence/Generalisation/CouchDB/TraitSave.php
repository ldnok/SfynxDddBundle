<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\CouchDB;

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
        $this->_dm->persist($entity);
        $this->_dm->flush();

        return $entity;
    }
}
