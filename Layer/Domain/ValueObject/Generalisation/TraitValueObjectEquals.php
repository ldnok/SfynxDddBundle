<?php

namespace Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation;

/**
 * Trait TraitValueObjectEquals
 * @package Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation
 */
trait TraitValueObjectEquals
{
    /**
     * @param ValueObjectInterface $other
     * @return bool
     */
    public function equals(ValueObjectInterface $other)
    {
        $classname = get_class($this);
        if (!($other instanceof $classname)) {
            throw new \InvalidArgumentException('Wrong Class for method equals');
        }

        return $this->__toString() === $other->__toString();
    }

    /**
     * Returns the string value itself
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->toNative();
    }
}
