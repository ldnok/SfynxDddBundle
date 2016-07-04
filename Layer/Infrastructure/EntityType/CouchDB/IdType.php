<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\EntityType\CouchDB;

use Sfynx\DddBundle\Layer\Domain\ValueObject\IdVO;
use Doctrine\ODM\CouchDB\Types\Type;

class IdType extends Type
{
    public function convertToCouchDBValue($value)
    {
        if ($value instanceof IdVO) {
            return $value->id();
        } else {
            return $value;
        }
    }

    public function convertToDatabaseValue($value)
    {
        if ($value instanceof IdVO) {
            return $value->id();
        } else {
            return $value;
        }
    }

    public function convertToPHPValue($value)
    {
        $className = $this->getNamespace().'\\'.$this->getName();

        return new $className($value);
    }

    public function getName()
    {
        return 'IdVO';
    }

    protected function getNamespace()
    {
        return 'Sfynx\DddBundle\Layer\Domain\ValueObject';
    }
}
