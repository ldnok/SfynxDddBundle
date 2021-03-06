<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\EntityType\Orm;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class EntityNameType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string) $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
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
