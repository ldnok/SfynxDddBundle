<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\EntityType\Odm;

use Doctrine\ODM\MongoDB\Types\Type;

class EntityNameType extends Type
{
    public function convertToDatabaseValue($value)
    {
        return (string) $value;
    }

    public function convertToPHPValue($value)
    {
        $className = $this->getNamespace().'\\'.$this->getName();

        return new $className($value);
    }

    public function getName()
    {
        return 'EntityNameVO';
    }

    protected function getNamespace()
    {
        return 'Sfynx\DddBundle\Layer\Domain\ValueObject';
    }
}
