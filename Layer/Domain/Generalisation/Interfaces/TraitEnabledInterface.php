<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Interfaces;

/**
 * FilmRepository interface
 * 
 */
interface TraitEnabledInterface
{
    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($boolean);
    
    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled();
}
