<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Entity;

/**
 * FilmRepository interface
 * 
 */
interface TraitPositionInterface
{
    /**
     * Set $position
     *
     * @param integer $position
     */
    public function setPosition($position);
    
    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition();
}
