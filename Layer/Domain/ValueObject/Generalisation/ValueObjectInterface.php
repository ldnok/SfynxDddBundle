<?php

namespace Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation;

/**
 * Interface ValueObjectInterface
 * @package Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation
 */
interface ValueObjectInterface
{
    /**
     * @return string
     */
    public function __toString();

    /**
     * @param ValueObjectInterface $other
     * @return bool
     */
    public function equals(ValueObjectInterface $other);
}
