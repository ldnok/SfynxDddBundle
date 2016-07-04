<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\EntityType\Odm;

use Sfynx\DddBundle\Layer\Domain\ValueObject\IdVO;
use Doctrine\ODM\MongoDB\Types\Type;

class IdType extends Type
{
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
