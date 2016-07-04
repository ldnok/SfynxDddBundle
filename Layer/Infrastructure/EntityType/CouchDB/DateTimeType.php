<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\EntityType\CouchDB;

use DateTime;
use Doctrine\ODM\CouchDB\Types\Type;

class DateTimeType extends Type
{
    public function convertToCouchDBValue($value)
    {
        return $value->format('Y-m-d H:i:s.u');
    }

    public function convertToPHPValue($value)
    {
        return DateTime::createFromFormat('Y-m-d H:i:s.u', $value);
    }

    public function getName()
    {
        return Datetime::class;
    }
}
