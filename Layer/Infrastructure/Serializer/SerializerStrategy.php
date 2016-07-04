<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Serializer;

use JMS\Serializer\SerializationContext;

class SerializerStrategy implements SerializerInterface
{
    protected $serializer;

    protected $serializationContext;

    public function __construct($serializer)
    {
        $this->serializer = $serializer;
        $this->setSerializationContext();
    }

    protected function setSerializationContext($context = null)
    {
        $this->serializationContext = $context;
        if (null === $context) {
            $this->serializationContext = SerializationContext::create();//let null ?
        }
    }

    public function serialize($data, $format, $context = null)
    {
        if(null === $this->serializationContext) {
            return $this->serializer->serialize($data, $format, $context);
        }
        return $this->serializer->serialize($data, $format, $this->serializationContext);
    }

    public function deserialize($data, $type, $format, $context = null)
    {
        return $this->serializer->deserialize($data, $format, $context);
    }

    public function getSerializationContext()
    {
        return $this->serializationContext;
    }
}
