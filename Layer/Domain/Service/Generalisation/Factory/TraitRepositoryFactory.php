<?php

namespace Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Factory;


trait TraitRepositoryFactory
{
    protected $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function getManager()
    {
        return $this->manager;
    }
}
