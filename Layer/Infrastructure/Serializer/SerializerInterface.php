<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Serializer;


interface SerializerInterface
{
    public function serialize($data, $format, $context = null);

    public function deserialize($data, $type, $format, $context = null);

    public function getSerializationContext();
}
